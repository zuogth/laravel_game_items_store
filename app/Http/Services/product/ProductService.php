<?php

namespace App\Http\Services\product;

use App\Helpers\Utils;
use App\Models\Bill;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function findAll()
    {
        try {
            return DB::table('PRODUCT')
                ->select('PRODUCT.*')
                ->selectRaw('if(PRODUCT.sold is null,0,PRODUCT.sold) as sold')
                ->get();
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return [];
        }
    }

    public function findByCode($code)
    {
        try {
            return DB::table('PRODUCT')
                ->select('PRODUCT.name',
                    'PRODUCT.price',
                    'PRODUCT.id',
                    'PRODUCT.code',
                    'PRODUCT.total_quantity')
                ->selectRaw('if(PRODUCT.sold is null,0,PRODUCT.sold) as sold')
                ->where('PRODUCT.code', $code)
                ->where('PRODUCT.status', 1)
                ->first();
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return new Product;
        }
    }

    public function findById($id)
    {
        try {
            return Product::find($id);
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return new Product;
        }
    }

    public function findByCate($cateId)
    {
        try {
            $products = DB::table('PRODUCT')
                ->where('PRODUCT.category_id', $cateId)
                ->where('PRODUCT.status', 1)
                ->select('PRODUCT.*')->get();
            return $products;
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return [];
        }
    }

    public function findByCateCodeAndStatus($cateCode, $status)
    {
        try {
            $category = DB::table('CATEGORY')
                ->where('CATEGORY.code', $cateCode)
                ->select('CATEGORY.*');
            $result = DB::table('PRODUCT')
                ->joinSub($category, 'b', 'PRODUCT.category_id', '=', 'b.id')
                ->select('PRODUCT.name', 'PRODUCT.price', 'PRODUCT.id', 'PRODUCT.code', 'PRODUCT.total_quantity'
                    , 'PRODUCT.sold', 'b.name as category_name', 'PRODUCT.status', 'b.code as category_code');


            if (!is_null($status)) {
                return $result->where('PRODUCT.status', $status)->get();
            }
            return $result->get();
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return [];
        }
    }

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
}
