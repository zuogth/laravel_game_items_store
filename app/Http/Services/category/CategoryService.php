<?php

namespace App\Http\Services\category;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    function findAllByStatus($status)
    {
        try {
            return $bills = DB::table('CATEGORY')
                ->where("status", $status)
                ->select('CATEGORY.*')->get();;
        } catch (\Exception $ex) {
            Log::error($ex);
            return [];
        }
    }
}
