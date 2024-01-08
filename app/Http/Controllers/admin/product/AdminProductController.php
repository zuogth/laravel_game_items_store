<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use App\Http\Services\product\ProductService;

class AdminProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($cateCode)
    {
        $products = $this->productService->findByCateCodeAndStatus($cateCode, null);
        return view('admin.product.list', [
            'title' => 'Sản phẩm',
            'products' => $products,
        ]);
    }

}
