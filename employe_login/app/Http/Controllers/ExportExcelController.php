<?php

namespace App\Http\Controllers;

use App\Exports\AttendHistoryExcel;
use App\Exports\ExportExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AttendacneController;
use DateInterval;
use DatePeriod;
use DateTime;

class ExportExcelController extends Controller
{
    public function excel(Request $request)
    {
        // $users = DB::table('model_test')->get();
        return Excel::download(new ExportExcel($request->recent_date), Auth::user()->e_id . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function attend_his_excel(Request $request)
    {
        $from_date = $request->his_from;
        $to_date = $request->his_to;
        if ($from_date != "" && $to_date != "") {
            if ($from_date <= $to_date) {
                $from_to_date = array();
                $period = new DatePeriod(
                    new DateTime($from_date),
                    new DateInterval('P1D'),
                    new DateTime($to_date)
                );
                foreach ($period as $key => $value) {
                    array_push($from_to_date, $value->format('Y-m-d'));
                }
                $date_one = date($to_date, strtotime('+1 day'));
                array_push($from_to_date, $date_one);
                return Excel::download(new AttendHistoryExcel($from_to_date), Auth::user()->e_id . '.csv', \Maatwebsite\Excel\Excel::CSV);
            } else {
                return redirect('/attendance');
            }
        } else {
            return redirect('/attendance');
        }
    }
}
