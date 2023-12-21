<?php

namespace App\Http\Controllers\bill;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Services\bill\BillService;
use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $expire = $bill->expire_date;
        $bill_code = $bill->bill_code;

        $content = $bill_code;
        $amount = (string)round($bill->total_price);

        $qr = $this->billService->callApiQR('', $amount);
        return view('bill.pay', [
            'title' => 'Thanh toán',
            'qr' => $qr->getData(),
            'amount' => $amount,
            'content'=> $content,
            'expireDate'=>$expire,
            'bill_code'=>$bill_code
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

    public function confirmPay($param){

        $bill = $this->billService->confirmPay($param);
        if(!$bill){
            return redirect()->back();
        }

        return redirect()->route('home');
    }
}
