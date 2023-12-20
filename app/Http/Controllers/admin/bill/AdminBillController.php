<?php

namespace App\Http\Controllers\admin\bill;

use App\Http\Controllers\Controller;
use App\Http\Services\admin\bill\AdminBillService;

class AdminBillController extends Controller
{
    protected AdminBillService $adminBillService;

    public function __construct(AdminBillService $adminBillService)
    {
        $this->adminBillService = $adminBillService;
    }

    public function index()
    {
        $bills = $this->adminBillService->findAll();
        return view('admin.bill.list', [
            'title' => 'Hoá đơn',
            'bills' => $bills
        ]);
    }
}
