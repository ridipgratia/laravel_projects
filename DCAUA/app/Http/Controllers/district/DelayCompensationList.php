<?php

namespace App\Http\Controllers\district;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyMethod\DistrictMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DelayCompensationList extends Controller
{
    public function index()
    {
        return view('district.delay_compensation_list');
    }
    public function form_list(Request $request)
    {
        if ($request->ajax()) {
            $columns = ['code_number', 'mr_number', 'recover_amount'];
            $lists = DistrictMethod::GetFormList('add_dc', $columns);
            return response()->json(['status' => 200, 'message' => $lists]);
        }
    }
    public function form_data(Request $request)
    {
        if ($request->ajax()) {
            $delay_form_id = $_GET['delay_form_id'];
            if (isset($delay_form_id)) {
                $district_code = Auth::user()->district;
                $delay_form_data = DB::table('add_dc')->where('district_id', $district_code)->where('id', $delay_form_id)->get();
                if (count($delay_form_data) == 0) {
                    $content = "<p>No data Found</p>";
                } else {
                    $img_url = Storage::url($delay_form_data[0]->bank_statement_url);
                    $content = '<p class="delay_para_head para_head">Work Code Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->code_number . '</p>
            <p class="delay_para_head para_head">MR Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->mr_number . '</p>
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
    public function search_data(Request $request)
    {
        if ($request->ajax()) {
            $from_date_form = $request->from_date_form;
            $to_date_form = $request->to_date_form;
            $form_data = DistrictMethod::searchByDate('add_dc', $from_date_form, $to_date_form);
            return response()->json(['status' => $form_data[0], 'message' => $form_data[1]]);
        }
    }
    public function get_gp_by_block(Request $request)
    {
        if ($request->ajax()) {
            $block_id = $_GET['block_id'];
            $gp_names = DistrictMethod::getGpByBlock($block_id);
            $content = "<option disabled selected>Select</option>";
            foreach ($gp_names as $gp_name) {
                $content .= '<option value="' . $gp_name->gram_panchyat_id . '">' . $gp_name->gram_panchyat_name . '</option>';
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    public function search_block_gp_dates(Request $request)
    {
        if ($request->ajax()) {
            $form_date = $request->from_date_form;
            $to_date = $request->to_date_form;
            $block_name = $request->block_name;
            $gp_name = $request->gp_name;
            $result = DistrictMethod::searchByBlockGpDates($form_date, $to_date, $block_name, $gp_name, 'add_dc');
            return response()->json(['status' => $result[0], 'message' => $result[1]]);
        }
    }
}
