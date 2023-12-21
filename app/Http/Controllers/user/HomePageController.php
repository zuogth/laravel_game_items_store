<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Services\product\ProductService;
use App\Http\Services\category\CategoryService;


class HomePageController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $result = [];
        $categorylist = $this->categoryService->findAllByStatus(1);

        foreach ($categorylist as $cate) {
            $result[$cate->name] = $this->productService->findByCate($cate->id);
        }
        return view('user.home', [
            'title' => 'Trang chủ',
            'mapProducts' => $result

        ]);
    }

    public function category($code)
    {
        $result = $this->productService->findByCateCode($code);
        return view('product.products', [
            'title' => "product",
            'products' => $result
        ]);
    }
}
