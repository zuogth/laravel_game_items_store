<?php

namespace App\Http\Services\bill;

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillService
{
    public function store(Request $request): bool
    {
        try {
            $expire = $this->getExpireDate();

            DB::table('PRODUCT')
                ->where('PRODUCT.id','=',(string)$request->input('product_id'))
                ->decrement('PRODUCT.total_quantity',$request->input('quantity'));

            Bill::create([
                'product_id' => (string)$request->input('product_id'),
                'expire_date' => $expire,
                'bill_code' => $request->input('bill_code'),
                'price'=> $request->input('price'),
                'quantity' => (string)$request->input('quantity'),
                'total_price' => $request->input('quantity') * $request->input('price'),
                'status' => '1'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex);
            return false;
        }
        return true;
    }

    public function findByBillCode($billCode){
        try {
            return DB::table('BILL')
                ->where('BILL.bill_code','=',$billCode)
                ->first();
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
            return new Bill();
        }
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

            Log::error($ex);
            return response()->json(['error' => $ex, 'code' => 'ERROR']);
        }
    }

    public function checkBill(): bool
    {
        try {

            $bills = DB::table('BILL')
                ->where('BILL.status','=','1')
                ->where('BILL.expire_date', '<=', now())
                ->get();
            foreach ($bills as $bill){
                DB::table('PRODUCT')
                    ->where('PRODUCT.id', '=', $bill->product_id)
                    ->increment('PRODUCT.total_quantity', $bill->quantity);
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

    private function getExpireDate(): Carbon
    {
        $expire = env('PAY_EXPIRE_TIME');

        $currentTime = Carbon::now();
        return $currentTime->addMinutes($expire);
    }
}
