<?php

namespace App\Http\Services\product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{


    public function findAll()
    {
        try {
            $bills = DB::table('BILL')
                ->where('BILL.status', '<>', '-1')
                ->where('BILL.status', '<>', '-2')
                ->select('BILL.*');

            return DB::table('PRODUCT')
                ->leftJoinSub($bills, 'b', 'PRODUCT.id', '=', 'b.product_id')
                ->select('PRODUCT.name', 'PRODUCT.price', 'PRODUCT.id', 'PRODUCT.code', 'PRODUCT.total_quantity as now_available')
                ->selectRaw('if(sum(b.quantity) is null,0,sum(b.quantity)) as sold')
                ->groupBy('PRODUCT.id', 'PRODUCT.name', 'PRODUCT.price', 'PRODUCT.total_quantity', 'PRODUCT.code')
                ->get();
        } catch (\Exception $ex) {
            Log::error($ex);
            return [];
        }
    }

    public function findByCode($code)
    {
        try {
            $bills = DB::table('BILL')
                ->where('BILL.status', '<>', '-1')
                ->select('BILL.*');

            return DB::table('PRODUCT')
                ->leftJoinSub($bills, 'b', 'PRODUCT.id', '=', 'b.product_id')
                ->select('PRODUCT.name', 'PRODUCT.price', 'PRODUCT.id', 'PRODUCT.code', 'PRODUCT.total_quantity as now_available')
                ->selectRaw('if(sum(b.quantity) is null,0,sum(b.quantity)) as sold')
                ->where('PRODUCT.code', $code)
                ->groupBy('PRODUCT.id', 'PRODUCT.name', 'PRODUCT.price', 'PRODUCT.total_quantity', 'PRODUCT.code')
                ->first();
        } catch (\Exception $ex) {
            Log::error($ex);
            return new Product;
        }

    }

    public function findByCate($cateId)
    {
        try {
            $products = DB::table('PRODUCT')
                ->where('PRODUCT.category_id', $cateId)
                ->select('PRODUCT.*')->get();
            return $products;
        } catch (\Exception $ex) {
            Log::error($ex);
            return [];
        }
    }

    public function findByCateCode($cateCode)
    {
        try {
            $category = DB::table('CATEGORY')
                ->where('CATEGORY.code', $cateCode)
                ->select('CATEGORY.*');
            return DB::table('PRODUCT')
                ->joinSub($category, 'b', 'PRODUCT.category_id', '=', 'b.id')
                ->select('PRODUCT.name', 'PRODUCT.price', 'PRODUCT.id', 'PRODUCT.code', 'PRODUCT.total_quantity','PRODUCT.sold')
                ->get();
        } catch (\Exception $ex) {
            Log::error($ex);
            return [];
        }
    }
}
