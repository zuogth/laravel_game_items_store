<?php

namespace App\Http\Controllers\bill;

use App\Http\Controllers\Controller;
use App\Http\Notification\Telegram;
use App\Http\Services\bill\BillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BillController extends Controller
{
    protected BillService $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function index($param)
    {
        $bill = $this->billService->findByBillCode($param);

        if (!$bill) {
            return redirect('/notfound');
        }
        $bill_code = $bill->bill_code;
        $expire = $bill->expire_date;

        $qr = null;

        $payType = $bill->pay_type;
        $viewName = 'bill.pay';

        $accountNo = env('API_QR_ACCOUNT');
        $accountName = env('API_QR_ACCOUNT_NAME');
        $bankName = env('BANK_NAME');

        $content = $bill_code;
        $amount = (string)round($bill->total_price);

        if ($payType == '2') {
            $viewName = 'bill.thesieure';

            $accountNo = env('ACCOUNT_THESIEURE');
            $accountName = env('ACCOUNT_NAME_THESIEURE');
        } else {
            $qr = $this->billService->callApiQR($content, $amount)->getData();
        }

        return view($viewName, [
            'title' => 'Thanh toán',
            'qr' => $qr,
            'amount' => $amount,
            'content' => $content,
            'expireDate' => $expire,
            'bill_code' => $bill_code,
            'accountNo' => $accountNo,
            'accountName' => $accountName,
            'bankName'=>$bankName
        ]);
    }

    public function store(Request $request)
    {
        $bill = $this->billService->store($request);
        if (!$bill) {
            return redirect()->back();
        }
        return redirect()->route('show_bill', [
            'bill_code' => $request->input('bill_code')
        ]);
    }

    public function confirmPay($param)
    {

        $bill = $this->billService->confirmPay($param);
        if (!$bill) {
            return redirect()->back();
        }

        return redirect()->route('home');
    }

    public function historyConfirm($param)
    {

        $bill = $this->billService->confirmPay($param);
        if (!$bill) {
            return redirect()->back();
        }

        return redirect()->route('history');
    }

    public function history()
    {
        $user = Auth::user();
        if(!$user){
            return redirect()->route('login');
        }
        $bills = $this->billService->findByUser($user->id);
        return view('bill.history',[
            'title'=>'Lịch sử mua hàng',
            'bills'=>$bills
        ]);
    }
}
