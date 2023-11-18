<?php

namespace App\Http\Controllers\district;

use App\Http\Controllers\Controller;
use App\MyMethod\UsedMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    public function index()
    {
        $emp_district = Auth::user()->district;
        $delay_data = DB::table('add_dc')->where('district_id', $emp_district)->count();
        $unemploye_data = DB::table('add_unemp_allowance')->where('district_id', $emp_district)->count();
        $auth_district = Auth::user()->district;
        $auth_block = NULL;
        $or_where = ['district_id', 999];
        $notifications = UsedMethod::getNotifications(Auth::user()->district, $or_where);
        $new_notify = UsedMethod::getNewNotify($notifications, $auth_district, $auth_block);
        return view('district.district_dashbaord', [
            'delay_form_list' => $delay_data,
            'unemp_allowance_form_list' => $unemploye_data,
            'new_notify' => $new_notify
        ]);
    }
}
