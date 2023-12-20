<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\bill\BillService;
use Illuminate\Support\Facades\Log;


class check_bill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill:check_bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected BillService $billService;

    public function __construct(BillService $billService)
    {
        parent::__construct();
        $this->billService = $billService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("RUN SCHEDULE CHECK PAY BILL");
        $this->billService->checkBill();
    }
}
