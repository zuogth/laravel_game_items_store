<?php

namespace App\Http\Services\bill;

use App\Mail\MyMail;
use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BillService
{
    public function store(Request $request): bool
    {
        try {
            $expire = $this->getExpireDate();
            $newAvail = $request->input('total_quantity') - $request->input('quantity');
            $newSold = $request->input('quantity') + $request->input('sold');

            DB::table('PRODUCT')
                ->where('PRODUCT.id', '=', (string)$request->input('product_id'))
                ->update([
                    'PRODUCT.total_quantity' => $newAvail,
                    'PRODUCT.sold' => $newSold,
                ]);

            Bill::create([
                'product_id' => (string)$request->input('product_id'),
                'expire_date' => $expire,
                'bill_code' => $request->input('bill_code'),
                'price' => $request->input('price'),
                'quantity' => (string)$request->input('quantity'),
                'total_price' => $request->input('quantity') * $request->input('price'),
                'status' => '1',
                'id_game' => (string)$request->input('id_game')
            ]);
        } catch (\Exception $ex) {
            Log::error($ex);
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
            Log::error($ex->getMessage());
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
            Log::error($ex->getMessage());
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

                // Process the data as needed
                // ...

                return response()->json($data);
            } else {
                // Handle the error
                $errorMessage = $response->status() . ' ' . $response->reason();
                Log::error($errorMessage);

                return response()->json(['error' => $errorMessage, 'code' => 'ERROR'], $response->status());
            }
        } catch (\Exception $ex) {

            Log::error($ex->getMessage());
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

                DB::table('PRODUCT')
                    ->where('PRODUCT.id', '=', $bill->product_id)
                    ->decrement('PRODUCT.sold', $bill->quantity);
            }
            DB::table('BILL')
                ->where('BILL.status', '=', '1')
                ->where('BILL.expire_date', '<=', now())
                ->update(['BILL.status' => '-2']);
        } catch (\Exception $ex) {
            Log::error($ex);
            return false;
        }
        Log::info('UPDATED CHECK PAY BILL');
        return true;
    }

    public function getTopBillByStatus($status,$top)
    {
        try {
            $bills = DB::table('BILL')
                ->where("status", $status)
                ->orderBy("bill_date", "DESC")
                ->take($top)
                ->select('BILL.*')->get();;
            return $bills;
        } catch (\Exception $ex) {
            Log::error($ex);
            return [];
        }
    }

    private function getExpireDate(): Carbon
    {
        $expire = 5;

        $currentTime = Carbon::now();
        return $currentTime->addMinutes($expire);
    }
}
