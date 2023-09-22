<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DelayConpensationFormListController extends Controller
{
    public function create()
    {
        // Load Delay Form List
        return view('delay_compensation_form_list');
    }
    public function form_list(Request $request)
    {

        // Get All Delay Form List To Datatable 

        if ($request->ajax()) {
            $emp_code = "emp_code_4";
            $delay_form_list_data = DB::table('add_dc')->where('submited_by', $emp_code)->select('id', 'date_of_submit', 'request_id', 'approval_status')->get();
            return response()->json(['message' => $delay_form_list_data]);
        }
    }
}
