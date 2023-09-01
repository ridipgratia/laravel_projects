<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\Object_;

use function PHPSTORM_META\type;

class AdminUserController extends Controller
{
    public function show()
    {
        $block_names = DB::table('blocks')->where('district_id', 407)->distinct()->get();
        return view('show_em_data', compact('block_names'));
    }
    public function get_gp($block_id)
    {
        $block_query = NULL;
        if ($block_id == 'all_block') {
            $gp_names = [];
        } else {
            $block_query = DB::table('gp')->where('block_id', $block_id);
            $gp_names = $block_query->get();
        }
        return response()->json(['message' => $gp_names]);
    }
    public function employe_for_approed_get()
    {
        $block_code = $_GET['block_code'];
        $gp_code = $_GET['gp_code'];
        $emp_query = NUll;
        if ($block_code == 'all_block' and $gp_code == "all_gp") {
            $emp_query = DB::table('employe_details as emp_de')->where('dist_id', 407);
        } else if ($block_code != "all_block" and $gp_code == "all_gp") {
            $emp_query = DB::table('employe_details as emp_de')->where('dist_id', 407)->where('blk_id', $block_code);
        } else if ($block_code == "all_block" and $gp_code != "all_gp") {
            $emp_query = DB::table('employe_details as emp_de')->where('dist_id', 407)->where('gpp_id', $gp_code);
        } else if ($block_code != "all_block" and $gp_code != "all_gp") {
            $emp_query = DB::table('employe_details as emp_de')->where('dist_id', 407)->where('blk_id', $block_code)->where('gpp_id', $gp_code);
        }
        $emp_data = $emp_query->select(
            'emp_de.id as id',
            'emp_de.employe_name as name',
            'emp_de.dist_id as district_id',
            'emp_de.blk_id as block_id',
            'emp_de.gpp_id as gp_id',
            'emp_block.block_name as block_name',
            'emp_gp.gp_name as gp_name',
            'emp_child.id as child_id',
            'emp_child.child_approved as child_approved',
            'emp_child.child_status as child_status'
        )
            ->join('employe_child as emp_child', 'emp_child.e_id', '=', 'emp_de.id')
            ->join('blocks as emp_block', 'emp_block.block_id', '=', 'emp_de.blk_id')
            ->join('gp as emp_gp', 'emp_gp.gp_id', '=', 'emp_de.gpp_id')->get();
        foreach ($emp_data as $data) {
            $approved = "";
            $class_name = "fa fa-eye";
            $id_name = "check_btn";
            if ($data->child_approved === 1) {
                $approved = "Approved";
            } else if ($data->child_approved === 0) {
                $approved = "Rejected";
            } else if ($data->child_approved === NULL) {
                $approved = "Pending";
            }
            $data->approved = $approved;
            if ($data->child_status == 0) {
                $id_name = "check_btn_des";
            }
            $data->id_name = $id_name;
        }
        return response()->json(['message' => $emp_data, 'block_code' => $block_code, 'gp_code' => $gp_code]);
    }
    public function child_for_approved_get()
    {
        $employe_id = $_GET['employe_id'];
        $child_data = DB::table('employe_child as emp_child')->where('e_id', $employe_id)->select(
            'emp_child.id as child_id',
            'emp_child.e_id as emp_id',
            'emp_child.no_child as no_child',
            'emp_child.child_status as child_status',
            'emp_child.child_approved as child_approved',
            'child_de.id as child_count_id',
            'child_de.child_name as name',
            'child_de.child_dob as dob',
            'child_de.child_gender as gender',
            'child_de.dob_doc as dob_doc',
            'child_de.child_disabled_file as disabled_file',
            'child_de.child_approval_status as approval_status'
            // 'child_de.education_status as education_status'
        )->join('child_details as child_de', 'emp_child.id', '=', 'child_de.child_id')
            ->get();
        $accept = "";
        $reject = "";
        // if (count($child_data) == 0) {
        //     $child_data = DB::table('employe_child as emp_child')->where('e_id', $employe_id)->select(
        //         'emp_child.e_id as emp_id',
        //         'emp_child.child_approved'
        //     )->get();
        // }
        // foreach ($child_data as $data) {
        //     if ($data->child_approved === NULL) {
        //         $accept = "accept_id";
        //         $reject = "reject_id";
        //     }
        //     $data->reject = $reject;
        //     $data->accept = $accept;
        // }
        return response()->json(['message' => $child_data]);
    }
    public function show_child_approved(Request $request)
    {
        // $emp_id = $request->emp_id;
        // $approval_id = $request->approval_id;
        // $emp_data = DB::table('employe_child as emp_child')->where('emp_child.e_id', $emp_id)->select(
        //     'emp_child.child_approved as child_approved'
        // )->get();
        // $mess = "";
        // $status = 0;
        // if (count($emp_data) === 0) {
        //     $mess = "Employe ID Not Found !";
        //     $status = 400;
        // } else {
        //     if ($emp_data[0]->child_approved === NULL) {
        //         if ($approval_id != 0 and $approval_id != 1) {
        //             $mess = "Someting Went Wrong !";
        //         } else {
        //             DB::table('employe_child')->where('e_id', $emp_id)->update(['child_approved' => $approval_id]);
        //             if ($approval_id == 0) {
        //                 $mess = "Succesfully Child Details Rejected ";
        //             } else if ($approval_id == 1) {
        //                 $mess = "Succesfully Child Details Approved ";
        //             } else {
        //                 $mess = "Someting Went Wrong !";
        //             }
        //             $status = 200;
        //         }
        //     } else {
        //         $mess = "Employe Child Approved Status Already Updated ";
        //         $status = 400;
        //     }
        // }
        // return response()->json(['status' => $status, 'message' => $mess]);
        if ($request->ajax()) {
            $child_id = $request->child_id;
            $aproval_index = $request->approval_id;
            $status = null;
            $message = null;
            $child_details = DB::table('child_details')->where('id', $child_id)->get();
            if (count($child_details) == 0) {
                $status = 400;
                $message = "Child Details Not Found ";
            } else {
                if ($child_details[0]->child_approval_status === null) {
                    try {
                        DB::table('child_details')->where('id', $child_id)->update(['child_approval_status' => $aproval_index]);
                        $status = 200;
                        if ($aproval_index === '1') {
                            $message = "Child Details Approved Successfully !";
                        } else if ($aproval_index === '0') {
                            $message = "Child Details Rejected Successfully !";
                        }
                    } catch (Exception $e) {
                        $status = 400;
                        $message = "Can't Approved Child Details ! Try Leter";
                    }
                } else {
                    $status = 400;
                    $message = "Child Details Already Approval !";
                }
            }
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
    public function show_child_img_get(Request $request)
    {
        if ($request->ajax()) {
            $imgUrl = Storage::url($_GET['url']);
            return response()->json(['message' => $imgUrl]);
        } else {
            return redirect('/show_em_data');
        }
    }
    public function zero_child_approve(Request $request)
    {
        if ($request->ajax()) {
            $emp_id = $request->employe_id;
            $status = null;
            $message = null;
            $index = null;
            $zero_child_details = DB::table('employe_child')->where('e_id', $emp_id)->get();
            if (count($zero_child_details) == 0) {
                $status = 200;
                $message = "Employe Not Found !";
            } else {
                $message = $zero_child_details;
                $status = 200;
                if ($zero_child_details[0]->child_approved === 1) {
                    $index = 1;
                } else if ($zero_child_details[0]->child_approved === 0) {
                    $index = 2;
                } else if ($zero_child_details[0]->child_approved === null) {
                    $index = 0;
                }
            }
            return response()->json(['status' => $status, 'message' => $zero_child_details, 'index' => $index]);
        } else {
            return redirect('/show_em_data');
        }
    }
    public function zero_child_approve_post(Request $request)
    {
        if ($request->ajax()) {
            $emp_id = $request->emp_id;
            $approval_index = $request->approval_index;
            $status = null;
            $message = null;
            if (isset($emp_id)) {
                $emp_data = DB::table('employe_child')->where('e_id', $emp_id)->get();
                if ($emp_data[0]->child_approved === null) {
                    if (count($emp_data) == 0) {
                        $status = 400;
                        $message = "No Employe's Child Details Found !";
                    } else {
                        try {
                            DB::table('employe_child')->where('e_id', $emp_id)->update(['child_approved' => $approval_index]);
                            $status = 200;
                            $message = "Suucessfully Approval Done !";
                        } catch (Exception $e) {
                            $status = 400;
                            $message = "Action Not Complete , Try Later";
                        }
                    }
                } else {
                    $status = 400;
                    $message = "Aleady Submited Approval Action ";
                }
            } else {
                $status = 400;
                $message = "No ID Found !";
            }
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            return redirect('/show_em_data');
        }
    }
}
