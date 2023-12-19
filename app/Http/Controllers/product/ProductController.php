<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Http\Services\product\ProductServiceClient;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductServiceClient $productService;
    public function __construct(ProductServiceClient $productService)
    {
        $this->productService=$productService;
    }

    public function index()
    {
        $products = array();
        $products=$this->productService->findAll();

        return view('product.products',[
            'title'=>'Trang chủ',
            'products'=>$products
        ]);
    }
}
