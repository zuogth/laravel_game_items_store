<?php

namespace App\Helpers;

class Utils
{
    public static function statusToString($status)
    {
        if ($status == 1) {
            return 'đang thanh toán';
        } elseif ($status == 2) {
            return 'xác minh';
        } elseif ($status == 3) {
            return 'thành công';
        } elseif ($status == -2) {
            return 'giao dịch hết hạn';
        } else
            return 'thất bại';
    }

    public static function generateBillCode(){
        $randomString = Str::random(10);
        $bill_code = $randomString . date("YmdHis");

        return $bill_code;
    }
}
