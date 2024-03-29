<?php

namespace App\Http\Controllers\product;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Services\product\ProductService;


class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function show($code)
    {

        $product = $this->productService->findByCode($code);
        if(!$product){
            return redirect('/notfound');
        }
        $bill_code = Utils::generateBillCode();

        return view('product.show', [
            'title' => $product->code,
            'product' => $product,
            'bill_code' => $bill_code
        ]);
    }
}
