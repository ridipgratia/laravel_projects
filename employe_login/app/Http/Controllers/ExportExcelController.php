<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function excel(Request $request)
    {
        // $users = DB::table('model_test')->get();
        return Excel::download(new ExportExcel($request->recent_date), Auth::user()->e_id . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
