<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Mymethods\RecentData;
use App\Mymethods\CheckIsNew;

class AttendHistoryExcel implements FromCollection, WithHeadings
{
    use RecentData;
    /**
     * @return \Illuminate\Support\Collection
     */
    public $from_to_date = null;
    public function __construct($from_to_date)
    {
        $this->from_to_date = $from_to_date;
    }
    public function collection()
    {
        $attend_his_data = array();
        $si = 1;
        foreach ($this->from_to_date as $dates) {
            if (CheckIsNew::check_date_available($dates)) {
                $attend_his = $this->getRecentData($dates);
                $attend_his[0]->id = $si;
                array_push($attend_his_data, $attend_his[0]);
                $si++;
            }
        }
        return collect($attend_his_data);
    }
    public function headings(): array
    {
        return ['SI No', "Employe Code ", "Login Date ", "Login Time", "Login Location Diffrence", 'Reason', "Logout Time ", "Logout Location Differance", 'Login Office ', 'Logout Office'];
    }
}
