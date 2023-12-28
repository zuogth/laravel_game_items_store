<?php

namespace App\Http\Services\admin\bill;

use App\Helpers\Utils;
use App\Models\Bill;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBillService
{
    public function findAll()
    {
        try {
            return DB::table('BILL')
                ->join('PRODUCT', 'BILL.product_id', '=', 'PRODUCT.id')
                ->select('BILL.*', 'PRODUCT.code as product_code')
                ->get();
            return $bills;
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return [];
        }
    }

    public function updateStatus($billNew, $id)
    {
        try {
            if (Bill::where("ID", $id)->exists()) {
                $bill = Bill::find($id);
                if (is_null($billNew->status)) {
                    Log::error("BILL STATUS NULL");
                    throw new \Exception();
                }
                // Update quantity
                if (!$this->updateQuantity($bill, $billNew->status))
                    return response()->json(["STATUS" => 500, "MESSAGES" => 'Sản phẩm trang kho đã hết'], 500);
                // TODO: VALIDATE
                $bill->status = $billNew->status;
                $bill->save();
                return response()->json(["STATUS" => 200, "MESSAGES" => 'Cập trạng thái mới của hoá đơn là: ' . Utils::statusToString($billNew->status)]);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());
            return response()->json(["STATUS" => 500, "MESSAGES" => 'Cập trạng thái hoá đơn thất bại '], 500);
        }

    }

    /*
     * success: sold + quantity
     * cancel: total_quantity + quantity
     * */

    private function updateQuantity($bill, $status)
    {
        if (Product::where("ID", $bill->product_id)->exists()) {
            $product = Product::find($bill->product_id);
            if ($status == 3) {
                $product->sold = $product->sold + $bill->quantity;
            } elseif ($status == -1) {
                $product->total_quantity = $product->total_quantity + $bill->quantity;
            }
            $product->save();
        }
        return true;
    }
}
