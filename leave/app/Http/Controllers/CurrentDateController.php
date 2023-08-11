<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrentDateController extends Controller
{
    public function current_date_get()
    {
        $current_month = date('F');
        $current_year = date('Y');
        $e_id = 1;
        $leave_id = array('1', '2', '3');
        $leave_balance = array();
        $incress_data = DB::table('leave_incress')->where('e_id', $e_id)->where('year', $current_year)->where('month', $current_month)->get();
        if (count($incress_data) == 0) {
            foreach ($leave_id as $id) {
                $balance = DB::table('leave_allocation')->where('e_id', $e_id)->where('leave_id', $id)->select('leave_balance')->get();
                $balance_incress = $balance[0]->leave_balance + 1;
                DB::table('leave_allocation')->where('e_id', $e_id)->where('leave_id', $id)->update(['leave_balance' => $balance_incress]);
            }
            DB::table('leave_incress')->insert(['e_id' => $e_id, 'year' => $current_year, 'month' => $current_month]);
        } else {
            echo 'Get Data';
        }
    }
}
