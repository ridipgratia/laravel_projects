<?php

namespace App\Http\Controllers\state;

use App\Http\Controllers\Controller;
use App\MyMethod\StateMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UnempAllowController extends Controller
{
    public function all_list()
    {
        return view('state.unemp_allow');
    }
    // Get Blocks By District Code
    public function get_blocks(Request $request)
    {
        if ($request->ajax()) {
            $district_code = $_GET['district_code'];
            $blocks = StateMethod::getBlocks($district_code);
            $content = "<option disabled selected>Select</option>";
            foreach ($blocks as $block) {
                $content .= '<option value="' . $block->block_id . '">' . $block->block_name . '</option>';
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    // Get Gps By Block Id
    public function get_gps(Request $request)
    {
        if ($request->ajax()) {
            $block_id = $_GET['district_code'];
            $gps = StateMethod::getGP($block_id);
            $content = "<option disabled selected>Select</option>";
            foreach ($gps as $gp) {
                $content .= '<option value="' . $gp->gram_panchyat_id . '">' . $gp->gram_panchyat_name . '</option>';
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    public function get_unemp_allow(Request $request)
    {
        $form_lists = StateMethod::getFormLists('add_unemp_allowance');
        return response()->json(['status' => 200, 'message' => $form_lists]);
    }
    public function view_form_by_id(Request $request)
    {
        if ($request->ajax()) {
            $delay_form_id = $_GET['delay_form_id'];
            if (isset($delay_form_id)) {
                $delay_form_data = DB::table('add_unemp_allowance')
                    ->where('id', $delay_form_id)
                    ->get();
                if (count($delay_form_data) == 0) {
                    $content = "<p>No data Found</p>";
                } else {
                    $img_url = Storage::url($delay_form_data[0]->bank_statement_url);
                    $content = '<p class="delay_para_head para_head">Work Code Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->card_number . '</p>
            <p class="delay_para_head para_head">MR Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->work_demand . '</p>
            <p class="delay_para_head para_head">Total Day of Unemployement</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->total_day_unemple . '</p>
            <p class="delay_para_head para_head">Person Responsible For Delay</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->person_delay . '</p>
            <p class="delay_para_head para_head">Designation Responsible For Delay</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->designation_delay . '</p>
            <p class="delay_para_head para_head">Recovered Amount</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->recover_amount . '</p>
            <p class="delay_para_head para_head">Date Amount Recovered</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_recover_amount . '</p>
            <p class="delay_para_head para_head">Date Deposited To Bank</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_deposite_bank . '</p>
            <p class="delay_para_head para_head">Date of Submited </p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_of_submit . '</p>
            <button id="show_form_document" class="btn btn-primary" value="' . $img_url . '">View Upload Document</button>';
                }
            } else {
                $content = "<p>No Data</p>";
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    public function search_query(Request $request)
    {
        if ($request->ajax()) {
            $form_date = $request->from_date_form;
            $to_date = $request->to_date_form;
            $block_name = $request->block_name;
            $gp_name = $request->gp_name;
            $district_name = $request->district_name;
            $result = StateMethod::searchByDisBloGpDates($form_date, $to_date, $district_name, $block_name, $gp_name, 'add_unemp_allowance');
            return response()->json(['status' => $result[0], 'message' => $result[1]]);
        }
    }
}
