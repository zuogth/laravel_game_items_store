<?php

namespace App\Http\Services\admin\bill;

use App\Helpers\Utils;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBillService
{
    public function findAll()
    {
        try {
            $bills = DB::table('BILL')
                ->orderBy("bill_date", "DESC")
                ->select('BILL.*')->get();;
            return $bills;
        } catch (\Exception $ex) {
            Log::error($ex);
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
                // TODO: VALIDATE
                $bill->status = $billNew->status;
                $bill->save();
                return response()->json(["STATUS" => 200, "MESSAGES" => 'Cập trạng thái mới của hoá đơn là: ' . Utils::statusToString($billNew->status)]);
            }
        } catch (\Exception $ex) {
            Log::error($ex);
            return response()->json(["STATUS" => 500, "MESSAGES" => 'Cập trạng thái hoá đơn thất bại '], 500);
        }

    }
}
