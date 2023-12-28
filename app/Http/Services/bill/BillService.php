<?php

namespace App\Http\Services\bill;

use App\Http\Services\product\ProductService;
use App\Mail\MyMail;
use App\Models\Bill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BillService
{
    public function store(Request $request): bool
    {
        try {

            $quantityProd = $this->checkQuantity($request->input('product_id'),$request->input('quantity'));
            if(!$quantityProd){
                return false;
            }

            $expire = $this->getExpireDate();

            Bill::create([
                'product_id' => $request->input('product_id'),
                'expire_date' => $expire,
                'bill_code' => $request->input('bill_code'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'total_price' => $request->input('quantity') * $request->input('price'),
                'status' => '1',
                'id_game' => (string)$request->input('id_game'),
                'pay_type' => (string)$request->input('pay_type'),
                'user_id'=>$request->input('user_id')
            ]);

            DB::table('PRODUCT')
                ->where('PRODUCT.id', '=', (string)$request->input('product_id'))
                ->decrement('PRODUCT.total_quantity',(int)$request->input('quantity'));

        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            Session::flash('error', 'Có lỗi xảy ra, xin thử lại sau!');
            return false;
        }
        return true;
    }

    public function findByBillCode($billCode)
    {
        try {
            return DB::table('BILL')
                ->join('PRODUCT', 'BILL.product_id', '=', 'PRODUCT.id')
                ->where('BILL.bill_code', '=', $billCode)
                ->where('BILL.status', '=', '1')
                ->select('BILL.*', 'PRODUCT.code as product_code')
                ->first();
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return new Bill();
        }
    }

    public function confirmPay($bill_code)
    {
        try {
            DB::table('BILL')
                ->where('BILL.bill_code', '=', $bill_code)
                ->update(['BILL.status' => '2']);

            $mailTo = env('MAIL_TO_ADDRESS');
            Mail::to($mailTo)->send(new MyMail($bill_code));

            Session::flash('success', 'Đã xác nhận thanh toán, xin đợi hệ thống xử lý');

        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            Session::flash('error', 'Có lỗi xảy ra, xin thử lại sau!');
            return false;
        }
        return true;
    }

    public function callApiQR($content, $amount): \Illuminate\Http\JsonResponse
    {
        try {
            $url = env('API_QR_URL');

            $postData = [
                'addInfo' => $content,
                'amount' => $amount,
                'accountNo' => env('API_QR_ACCOUNT'),
                'accountName' => env('API_QR_ACCOUNT_NAME'),
                'acqId' => env('API_QR_BANK_CODE'),
                'template' => env('API_QR_TEMPLATE')
            ];

            $response = Http::post($url, $postData);

            // Check if the request was successful (status code 2xx)
            if ($response->successful()) {
                // Access the response body as an array or JSON object
                $data = $response->json();

                return response()->json($data);
            } else {
                // Handle the error
                $errorMessage = $response->status() . ' ' . $response->reason();
                Log::error($errorMessage);

                return response()->json(['error' => $errorMessage, 'code' => 'ERROR'], $response->status());
            }
        } catch (\Exception $ex) {

            Log::error($ex->getTraceAsString());
            return response()->json(['error' => $ex->getMessage(), 'code' => 'ERROR']);
        }
    }

    public function checkBill(): bool
    {
        try {

            $bills = DB::table('BILL')
                ->where('BILL.status', '=', '1')
                ->where('BILL.expire_date', '<=', now())
                ->get();
            foreach ($bills as $bill) {
                DB::table('PRODUCT')
                    ->where('PRODUCT.id', '=', $bill->product_id)
                    ->increment('PRODUCT.total_quantity', $bill->quantity);
            }
            DB::table('BILL')
                ->where('BILL.status', '=', '1')
                ->where('BILL.expire_date', '<=', now())
                ->update(['BILL.status' => '-2']);
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return false;
        }
        Log::info('UPDATED CHECK PAY BILL');
        return true;
    }

    public function getTopBillByStatus($status, $top)
    {
        try {
            $bills = DB::table('BILL')
                ->where("status", $status)
                ->orderBy("bill_date", "DESC")
                ->take($top)
                ->select(\DB::raw('SUBSTRING(bill_code,1,15) as bill_code'), 'BILL.bill_date', 'BILL.pay_type', 'BILL.total_price')->get();
            return $bills;
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return [];
        }
    }

    public function findByUser($userId)
    {
        try {
            return DB::table('BILL')
                ->join('PRODUCT','PRODUCT.id','=','BILL.product_id')
                ->where('BILL.user_id','=',$userId)
                ->select('BILL.*','PRODUCT.code as product_code')
                ->get();
        }catch (\Exception $ex){
            Log::error($ex->getTraceAsString());
            Session::flash('error', 'Có lỗi xảy ra, xin thử lại sau!');
            return [];
        }
    }

    private function checkBillExpireByUser($user_id): bool
    {
        try {
            $bill_expire = DB::table('BILL')
                ->where('user_id','=',$user_id)
                ->where(function ($query){
                    $query->where('status','=','-1')
                        ->orWhere('status','=','-2');
                })
                ->selectRaw('count(*) as bill_expire')
                ->first();
            if(!$bill_expire || $bill_expire->bill_expire >= 5){
                Session::flash('error', 'Tài khoản cua bạn ta thời không thể giao dịch do vi phạm quá số lần đơn hàng không hoàn thành. Vui lòng liên hệ quản trị viên để thêm thông tin!');
                return false;
            }
        }catch (\Exception $ex){
            Log::error($ex->getTraceAsString());
            Session::flash('error', 'Có lỗi xảy ra, xin thử lại sau!');
            return false;
        }
        return true;
    }

    private function checkQuantity($productId,$quantity): bool
    {
        try {
            $product = DB::table('PRODUCT')
                ->where('id','=',$productId)
                ->where('total_quantity','>=',$quantity)
                ->first();

            if(!$product){
                Session::flash('error', 'Sản phẩm này hiện không tồn tại hoặc số lượng không đủ!');
                return false;
            }
        }catch (\Exception $ex){
            Log::error($ex->getTraceAsString());
            Session::flash('error', 'Có lỗi xảy ra, xin thử lại sau!');
            return false;
        }
        return true;
    }

    private function getExpireDate(): Carbon
    {
        $expire = 5;

        $currentTime = Carbon::now();
        return $currentTime->addMinutes($expire);
    }
}
