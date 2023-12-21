<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Http\Services\product\ProductService;
use App\Helpers\Utils;
use Illuminate\Support\Str;


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
        $bill_code = Utils::generateBillCode();

        return view('product.show', [
            'title' => $product->name,
            'product' => $product,
            'bill_code' => $bill_code
        ]);
    }
}
