<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Services\admin\AdminBillService;
use App\Http\Services\admin\AdminProductService;

class DashboardController extends Controller
{
    protected AdminProductService $adminProductService;

    public function __construct(AdminProductService $adminProductService)
    {
        $this->adminProductService = $adminProductService;
    }

    public function index()
    {
        $productInfo = $this->adminProductService->getStatusWebAndTotalProduct();
        return view('admin.dashboard', [
            'title' => 'Bảng điều khiển',
            'productInfo' => $productInfo
        ]);
    }

}
