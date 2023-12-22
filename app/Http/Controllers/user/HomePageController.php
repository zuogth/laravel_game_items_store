<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Services\bill\BillService;
use App\Http\Services\category\CategoryService;
use App\Http\Services\product\ProductService;


class HomePageController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;
    protected BillService $billService;

    public function __construct(ProductService $productService, CategoryService $categoryService, BillService $billService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->billService = $billService;
    }

    public function index()
    {

        $result = [];
        $categorylist = $this->categoryService->findAllByStatus(1);

        foreach ($categorylist as $cate) {
            $result[$cate->name] = $this->productService->findByCate($cate->id);
        }

        $bills = $this->billService->getTopBillByStatus(3, 20);

        return view('user.home', [
            'title' => 'Trang chủ',
            'mapProducts' => $result,
            'bills' => $bills
        ]);
    }

    public function category($code)
    {
        $result = $this->productService->findByCateCode($code);
        if (!is_null($result->first())) {
            return view('product.products', [
                'title' => $result->first()->category_name,
                'products' => $result
            ]);
        } else {
            return redirect()->to('/');
        }

    }
}
