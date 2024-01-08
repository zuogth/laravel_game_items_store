<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\admin\AdminBillService;
use Illuminate\Http\Request;

class AdminBillApi extends Controller
{
    protected AdminBillService $adminBillService;

    public function __construct(AdminBillService $adminBillService)
    {
        $this->adminBillService = $adminBillService;
    }


    public function index()
    {
        $bills = $this->adminBillService->findAll();
        return response()->json($bills);
    }


    public function update(Request $request, $id)
    {
        return $this->adminBillService->updateStatus($request, $id);
    }
}
