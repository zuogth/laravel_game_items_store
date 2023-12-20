<?php

namespace App\Http\Services\bill;

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BillService
{


    public function store(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $randomString = Str::random(10);
            $bill_code = $randomString . date("YmdHis");

            $currentTime = Carbon::now();
            $currentTimePlus5Minutes = $currentTime->addMinutes(5);

            $user = Bill::create([
                'product_id' => (string)$request->input('product_id'),
                'expire_date' => $currentTime,
                'bill_code' => $bill_code,
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

    public function callApiQR($content, $amount)
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

}
