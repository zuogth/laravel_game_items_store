<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Http\Services\bill\BillService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected BillService $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }


    public function store(Request $request)
    {

        // $bill = $this->billService->store($request);
        // if(!$bill){
        //     Session::flash('error','Có lỗi xảy ra, xin thử lại sau!');
        //     return redirect()->back();;
        // }
        $qr = $this->billService->callApiQR('test', '1000');

        return view('bill.pay', [
            'title' => 'Thanh toán',
            'qr' => $qr->getData()
        ]);
    }
}
