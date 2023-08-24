<?php

namespace App\Http\Controllers;

use App\Exports\ExportModify;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function view_export()
    {
        return Excel::download(new ExportModify, 'users.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    }
}
