<?php

namespace App\Http\Controllers\state;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SendNotificationController extends Controller
{
    public function index()
    {
        $districts = DB::table('districts')
            ->select('district_code', 'district_name')
            ->orderBy('district_name', 'asc')
            ->get();
        return view('state.send_notification', [
            'districts' => $districts
        ]);
    }
    public function store_notification(Request $request)
    {
        if ($request->ajax()) {
            $district_code = $request->district_code;
            $block_code = $request->block_code;
            $notify_file = $request->notify_file;
            $notify_text = $request->notify_text;
            $status = null;
            $message = null;
            if ($request->hasFile('notify_file')) {
                $message = "Ok";
            }
            if (empty($notify_text)) {
                $message = "Type Your Notification ";
            } else {
                $check = null;
                if ($request->hasFile('notify_file')) {
                    $message = "Ok";
                } else {
                    $message = "No File";
                }
            }
            return response()->json(['status' => 200, 'message' => $message]);
        }
    }
}
