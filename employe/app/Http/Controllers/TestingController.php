<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class TestingController extends Controller
{
    public function testing_show()
    {
        // $emp_data = DB::table('employe_details as emp_de')->where('dist_id', 407)->where('blk_id', 407001)->where('gpp_id', 407001001)->select(
        //     'emp_de.id as id',
        //     'emp_de.employe_name as name',
        //     'emp_de.dist_id as district_id',
        //     'emp_de.blk_id as block_id',
        //     'emp_de.gpp_id as gp_id',
        //     'emp_block.block_name as block_name',
        //     'emp_gp.gp_name as gp_name'
        // )
        //     ->join('employe_child as emp_child', 'emp_child.e_id', '=', 'emp_de.id')->where('child_approved', NULL)
        //     ->join('blocks as emp_block', 'emp_block.block_id', '=', 'emp_de.blk_id')
        //     ->join('gp as emp_gp', 'emp_gp.gp_id', '=', 'emp_de.gpp_id')->get();
        // $emp_data = DB::table('employe_child as emp_child')->where('e_id', 3)->select(
        //     'emp_child.id as child_id',
        //     'emp_child.e_id as emp_id',
        //     'emp_child.no_child as no_child',
        //     'child_de.child_name as name',
        //     'child_de.child_dob as dob',
        //     'child_de.child_gender as gender',
        //     'child_de.dob_doc as dob_doc',
        //     'child_de.education_status as education_status'
        // )->join('child_details as child_de', 'emp_child.id', '=', 'child_de.child_id')->get();
        DB::table('employe_child')->where('e_id', 2)->update(['child_approved' => 1]);
        // dd($emp_data);
    }
}
