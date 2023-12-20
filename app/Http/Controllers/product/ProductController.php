<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Http\Services\product\ProductService;


class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {

        $products = $this->productService->findAll();

        return view('product.products', [
            'title' => 'Trang chủ',
            'products' => $products
        ]);
    }

    public function show($code)
    {

        $product = $this->productService->findByCode($code);

        return view('product.show', [
            'title' => $product->name,
            'product' => $product
        ]);
    }


}
