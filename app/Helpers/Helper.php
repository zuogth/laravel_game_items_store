<?php

namespace App\Helpers;

use App\Http\Services\Client\ProductClient\ProductServiceClient;
use NumberFormatter;

class Helper
{
    /*
       -2: hết thời gian
       -1: huỷ
    `   1: khách hàng đang thanh toán (sau khi chuyển tiền khách hàng ấn xác minh status 1 -> 2)
        2: chờ quản trị xác mình
            -   quản trị nhận đc tiền -> 3
            -   chưa nhận đc tiền chuyển -> -1
        3: thành công
    */
    public static function statusBill($status): string
    {
        if ($status == 1) {
            return '<button name="status" class="btn btn-block btn-warning btn-sm">Đang thanh toán</button>';
        } elseif ($status == 2) {
            return '<button name="status" class="btn btn-block btn-info btn-sm">Xác minh</button>';
        } elseif ($status == 3) {
            return '<button name="status" class="btn btn-block btn-success btn-sm">Thành công</button>';
        } elseif ($status == -2) {
            return '<button name="status" class="btn btn-block btn-secondary btn-sm">Giao dịch hết hạn</button>';
        } else
            return '<button name="status" class="btn btn-block btn-danger btn-sm">Thất bại</button>';
    }

    public static function canHandleBill($status, $id): string
    {
        if ($status == 1) {
            return '<button name="status" class="btn btn-block btn-warning btn-sm">Đang thanh toán</button>';
        } elseif ($status == 2) {
            return "<div><button name='status' class='btn btn-block btn-success btn-sm btn-bill-status' data-id='$id' data-status='3'>Thành công</button>
            <button name='status' class='btn btn-block btn-danger btn-sm btn-bill-status' data-id='$id' data-status='-1'>Thất bại</button></div>";
        }
        return "";
    }


    public static function price($price)
    {
        if ($price >= 0) {
            $fmt = new NumberFormatter('it-IT', NumberFormatter::CURRENCY);
            return $fmt->formatCurrency($price, "VND");
        }
        return '_';
    }
}
