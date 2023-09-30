<?php

namespace App\Http\Controllers\state;

use App\Http\Controllers\Controller;
use App\MyMethod\AddUserByState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListPoController extends Controller
{
    public function list_po()
    {
        return view('state.list_po');
    }
    public function for_table(Request $request)
    {
        if ($request->ajax()) {
            $po_list = AddUserByState::user_list('make_po');
            return response()->json(['status' => 200, 'message' => $po_list]);
        }
    }
    public function view_data(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['id'];
            $status = 200;
            $content = "";
            $user_data = DB::table('make_po as main_table')
                ->where('main_table.id', $id)
                ->select(
                    'main_table.*',
                    'join_table.block_name as join_col_name'
                )->join('blocks as join_table', 'join_table.block_id', '=', 'main_table.block_id')
                ->get();
            if (count($user_data) == 0) {
                $status = 400;
                $content = "Can't Find User Details ";
            } else {
                $content = AddUserByState::user_html_data($user_data);
            }
            return response()->json(['status' => $status, 'content' => $content]);
        }
    }
    public function reset_pass(Request $request)
    {
        if ($request->ajax()) {
            $result = AddUserByState::resetUserPass($request, 'make_po');
            return response()->json(['status' => $result[0], 'message' => $result[1]]);
        }
    }
    public function remove_user(Request $request)
    {
        if ($request->ajax()) {
            $result = AddUserByState::RemoveUser($request, 'make_po');
            return response()->json(['status' => $result[0], 'message' => $result[1]]);
        }
    }
}
