<?php

namespace App\Http\Controllers\district;

use App\Http\Controllers\Controller;
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
        return view('district.district_dashbaord', [
            'delay_form_list' => $delay_data,
            'unemp_allowance_form_list' => $unemploye_data
        ]);
    }
}
