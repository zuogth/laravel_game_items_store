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
                    'PRODUCT.total_quantity as now_available')
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
                    'PRODUCT.total_quantity as now_available')
                ->selectRaw('if(PRODUCT.sold is null,0,PRODUCT.sold) as sold')
                ->where('PRODUCT.code', $code)
                ->first();
        } catch (\Exception $ex) {
            Log::error($ex);
            return new Product;
        }

    }

}
