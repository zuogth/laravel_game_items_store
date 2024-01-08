<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\admin\AdminProductService;
use App\Http\Services\product\ProductService;
use Illuminate\Http\Request;

class AdminProductApi extends Controller
{
    protected AdminProductService $adminProductService;

    public function __construct(AdminProductService $adminProductService)
    {
        $this->adminProductService = $adminProductService;
    }


    public function updateStatus(Request $request, $productCode)
    {
        return $this->adminProductService->updateProductStatus($request, $productCode);
    }

    public function controlStatus(Request $request)
    {
        return $this->adminProductService->controlStatus($request);
    }
}
