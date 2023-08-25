<?php

namespace App\Exports;

use App\Models\Employe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcel implements WithHeadings, FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $recent_date = null;
    public function __construct($recent_date = null)
    {
        $this->recent_date = $recent_date;
    }
    public function collection()
    {
        $export_query = null;
        if ($this->recent_date == null) {
            $export_query = DB::table('attendance_login as attend_log')->where('attend_log.e_id', Auth::user()->e_id);
        } else {
            $export_query = DB::table('attendance_login as attend_log')->where('attend_log.e_id', Auth::user()->e_id)->where('login_date', $this->recent_date);
        }
        // return Employe::where('e_id', 13)->get(['e_id', 'login_date', 'login_time', 'login_location_diff', 'reason', 'logout_time', 'logout_diff']);
        $emp_attend_data = $export_query
            ->join('locations as loc', 'loc.id', '=', 'attend_log.location_id')
            ->select(
                'attend_log.id as id',
                'e_id',
                'login_date',
                'login_time',
                'login_location_diff',
                'reason',
                'logout_time',
                'logout_diff',
                'loc.office_name as office_name',
            )->get();
        $si_no = 1;
        foreach ($emp_attend_data as $emp_attend) {
            if ($emp_attend->logout_time != null) {
                $attend_logout = DB::table('attendance_login as attend')->where('attend.e_id', Auth::user()->e_id)
                    ->where('attend.id', $emp_attend->id)
                    ->join('locations as loc', 'loc.id', '=', 'attend.logout_location_id')
                    ->select('loc.office_name as office_name')
                    ->get();
                $emp_attend->logout_location = $attend_logout[0]->office_name;
            }
            $emp_attend->id = $si_no;
            $si_no = $si_no + 1;
        }
        return collect($emp_attend_data);
    }

    public function headings(): array
    {
        return ['SI', "Employe Code ", "Login Date ", "Login Time", "Login Location Diffrence", 'Reason', "Logout Time ", "Logout Location Differance", 'Login Office ', 'Logout Office'];
    }
}
