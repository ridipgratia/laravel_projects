<div class="flex_div detalis_div" id="basic_div">
    <div class="flex_div details_div_1 detaling_div">
        <div class="flex_div details_div_3 detaling_div_1">
            <p class="flex_div details_p"><span>Father Name
                    :</span><span>{{ $employe_data[0]->employe_father_name }}</span></p>
            <p class="flex_div details_p"><span>Mother Name
                    :</span><span>{{ $employe_data[0]->employe_mother_name }}</span></p>
            <p class="flex_div details_p"><span>Gender Name :</span><span>{{ $employe_data[0]->gender }}</span></p>
            <p class="flex_div details_p"><span>Designation Name
                    :</span><span>{{ $employe_data[0]->designation_name }}</span></p>
            <p class="flex_div details_p"><span>Date Of Birth :</span><span>{{ $employe_data[0]->DOB }}</span></p>
            <p class="flex_div details_p"><span>Join Date :</span><span>{{ $employe_data[0]->join_date }}</span></p>
            <p class="flex_div details_p"><span>Email ID :</span><span
                    id="show_email">{{ $employe_data[0]->email }}</span></p>
            <p class="flex_div details_p"><span>Blood Group :</span><span>{{ $employe_data[0]->blood_group }}</span></p>
        </div>
    </div>
    <div class="fle_div details_div_1 detaling_div">
        <div class="flex_div details_div_3 detaling_div_1">
            <p class="flex_div details_p"><span>Bank Name :</span><span>{{ $employe_data[0]->bank_name }}</span></p>
            <p class="flex_div details_p"><span>Account No :</span><span>{{ $employe_data[0]->account_no }}</span></p>
            <p class="flex_div details_p"><span>IFSC Code :</span><span>{{ $employe_data[0]->IFSC_code }}</span></p>
            <p class="flex_div details_p"><span>Branch Name :</span><span>{{ $employe_data[0]->branch_name }}</span>
            </p>
        </div>
    </div>
</div>
