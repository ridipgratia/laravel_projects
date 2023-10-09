<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $emp_code = 'emp_code_4';
        $delay_data = DB::table('add_dc')->where('submited_by', $emp_code)->count();
        $unemploye_data = DB::table('add_unemp_allowance')->where('submited_by', $emp_code)->count();
        return view('block_dash', [
            'delay_form_list' => $delay_data,
            'unemp_allowance_form_list' => $unemploye_data
        ]);
    }
}
