<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewEmployeData extends Controller
{
    public function employe_show()
    {
        return view('view_employe');
    }
    public function upload_employe_fun(Request $request)
    {
        $child_name = $request->child_name;
        $file = $request->child_file;
        $temp = $file->store('public/images/' . $child_name);
        return response()->json(['status' => 200, 'message' => $child_name]);
    }
}
