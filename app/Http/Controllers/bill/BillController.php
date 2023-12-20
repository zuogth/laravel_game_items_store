<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Http\Services\bill\BillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\String\b;

class BillController extends Controller
{
    protected BillService $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function index($param){
        $bill = $this->billService->findByBillCode($param);
        $amount = (string)round($bill->total_price);
        $content = '';
        $expire = $bill->expire_date;

        $qr = $this->billService->callApiQR('', $amount);
        return view('bill.pay', [
            'title' => 'Thanh toán',
            'qr' => $qr->getData(),
            'amount' => $amount,
            'content'=> $content,
            'expireDate'=>$expire
        ]);
    }

    public function store(Request $request)
    {
        $bill = $this->billService->store($request);
        if (!$bill) {
            Session::flash('error', 'Có lỗi xảy ra, xin thử lại sau!');
            return redirect()->back();
        }

        return redirect()->route('show_bill', [
            'bill_code'=>$request->input('bill_code')
        ]);
    }
}
