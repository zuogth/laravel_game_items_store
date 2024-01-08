<?php

namespace App\Http\Services\admin;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminProductService
{
    public function updateProductStatus($request, $code)
    {
        try {
            if (Product::where("CODE", $code)->exists()) {
                $product = Product::where("CODE", $code)->first();
                if (is_null($request->status)) {
                    Log::error("PRODUCT STATUS DOES NOT NULL");
                    throw new \Exception();
                }

                $product->status = $request->status;
                $product->save();
                return response()->json(["STATUS" => 200, "MESSAGES" => 'Cập trạng thái sản phẩm thành công']);
            } else {
                return response()->json(["STATUS" => 500, "MESSAGES" => 'Sản phẩm không tồn tại'], 500);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return response()->json(["STATUS" => 500, "MESSAGES" => 'Cập trạng thái sản phẩm thất bại'], 500);
        }
    }

    public function getStatusWebAndTotalProduct()
    {
        try {
            return DB::table('PRODUCT')
                ->selectRaw('SUM(if(PRODUCT.status = 2, 1, 0)) as active, count(PRODUCT.status) as total')
                ->first();
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            throw  $ex;
        }
    }

    public function controlStatus($request)
    {
        try {
            if (is_null($request->status)) {
                Log::error("STATUS DOES NOT NULL");
                throw new \Exception();
            }
            DB::table('PRODUCT')
                ->where("status", '<>', '0')
                ->update(['status' => $request->status]);
            return response()->json(["STATUS" => 200, "MESSAGES" => 'Cập trạng thái hệ thống thành công']);
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return response()->json(["STATUS" => 500, "MESSAGES" => 'Cập trạng thái hệ thống thất bại'], 500);
        }
    }

}
