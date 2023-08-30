<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LeaveBalanceUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employe_leave:LeaveBalanceUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Employe Leave Balance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Kolkata');
        $year = date('Y');
        // $year = "2024";
        $current_month_1 = date('m');
        $leave_allocation_year = DB::select(DB::raw('select e_id from leave_allocation where year <> ' . $year));
        foreach ($leave_allocation_year as $leave_allocation_id) {
            DB::table('leave_allocation')
                ->insert(['e_id' => $leave_allocation_id->e_id, 'leave_id' => 1, 'year' => $year, 'leave_allocation' => 12, 'leave_balance' => $current_month_1, 'last_update_month' => $current_month_1]);
            DB::table('leave_allocation')
                ->insert(['e_id' => $leave_allocation_id->e_id, 'leave_id' => 2, 'year' => $year, 'leave_allocation' => 7, 'leave_balance' => 7]);
            Log::info($leave_allocation_id->e_id);
        }
        Log::info(count($leave_allocation_year));
        return 0;
    }
}
