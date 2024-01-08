<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\product\ProductService;
use Illuminate\Http\Request;

class AdminProductApi extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function updateStatus(Request $request, $productCode)
    {
        return $this->productService->updateProductStatus($request, $productCode);
    }
}
