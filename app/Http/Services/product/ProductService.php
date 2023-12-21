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

            return DB::table('PRODUCT')
                ->select('PRODUCT.name',
                    'PRODUCT.price',
                    'PRODUCT.id',
                    'PRODUCT.code',
                    'PRODUCT.total_quantity')
                ->selectRaw('if(PRODUCT.sold is null,0,PRODUCT.sold) as sold')
                ->get();
        } catch (\Exception $ex) {
            Log::error($ex);
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
                ->select('PRODUCT.name', 'PRODUCT.price', 'PRODUCT.id', 'PRODUCT.code', 'PRODUCT.total_quantity', 'PRODUCT.sold', 'b.name as category_name')
                ->get();
        } catch (\Exception $ex) {
            Log::error($ex);
            return [];
        }
    }
}
