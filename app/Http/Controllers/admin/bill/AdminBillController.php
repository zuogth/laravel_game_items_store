<?php

namespace App\Http\Controllers\admin\bill;

use App\Http\Controllers\Controller;
use App\Http\Services\admin\bill\AdminBillService;
use http\Env\Response;

class AdminBillController extends Controller
{
    protected AdminBillService $adminBillService;

    public function __construct(AdminBillService $adminBillService)
    {
        $this->adminBillService = $adminBillService;
    }

    public function index()
    {
        if (request()->ajax()) {
            $bills = $this->adminBillService->findAll();
            return datatables()->of($bills)->make(true);
        }
        return view('admin.bill.list', [
            'title' => 'Hoá đơn',
        ]);
    }

}
