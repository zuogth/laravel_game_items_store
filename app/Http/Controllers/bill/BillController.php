<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Services\bill\BillServiceClient;
use Illuminate\Support\Facades\Session;

class BillController extends Controller
{
    protected BillServiceClient $billService;
    public function __construct(BillServiceClient $billService)
    {
        $this->billService=$billService;
    }


    public function store(Request $request){

        // $bill = $this->billService->store($request);
        // if(!$bill){
        //     Session::flash('error','Có lỗi xảy ra, xin thử lại sau!');
        //     return redirect()->back();;
        // }
        $qr = $this->billService->CallApiQR('test','1000');

        return view('bill.pay',[
            'title'=>'Thanh toán',
            'qr'=>$qr->getData()
        ]);
    }
}
