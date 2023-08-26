{{-- <div class="flex_div main_attend_his_div">
    <div class="flex_div attend_his_div">
        <h1 class="attend_his_head">Attendance History Filter</h1>
        <form action="/export_1" method="post" class="flex_div attend_his_div_1">
            @csrf
            <div class="flex_div select_his_div">
                <p>Select Date From </p>
                <input type="date" name="his_from" id="his_from">
            </div>
            <div class="flex_div select_his_div">
                <p>Select Date To</p>
                <input type="date" name="his_to" id="his_to">
            </div>
            <div class="flex_div select_his_div select_his_div_1">
                <p style="opacity:0">Text</p>
                <button type="button" id="attend_his_export_btn">Search</button>
            </div>
            <div class="flex_div attend_his_export">
                <button type="submit" class="his_export_btn"><i class="fa fa-download"></i></button>
            </div>
        </form> --}}
{{-- <div class="flex_div attend_his_data_div">
            <div class="flex_div main_attend_his_data_div">
                <div class="flex_div attend_his_data_div_1">
                    <div class="flex_div attend_his_data_div_2">
                        <div class="flex_div attend_his_data_div_3 attend_color_1">
                            <p class="attend_his_data_count">1</p>
                            <p class="attend_his_data_head">Login</p>
                        </div>
                        <div class="flex_div attend_his_data_4">
                            <p class="flex_div attend_his_data_label attend_his_data_label_text">
                                <span><i class="fa fa-calendar-day"></i> Date</span>
                                <span><i class="fa fa-clock"></i> Signin Time</span>
                                <span><i class="fa fa-location-arrow"></i> Signin Distance</span>
                            </p>
                            <p class="flex_div attend_his_data_label_data attend_his_data_label_text">
                                <span>10-08-2023</span>
                                <span>10:20</span>
                                <span>9.30 Meter</span>
                            </p>
                            <p class="attend_his_data_office">
                                <span><i class="fa fa-building"></i> HRMS</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex_div attend_his_data_div_2">
                        <div class="flex_div attend_his_data_div_3 attend_color_2">
                            <p class="attend_his_data_count">1</p>
                            <p class="attend_his_data_head">Logout</p>
                        </div>
                        <div class="flex_div attend_his_data_4">
                            <p class="flex_div attend_his_data_label attend_his_data_label_text">
                                <span><i class="fa fa-calendar-day"></i> Date</span>
                                <span><i class="fa fa-clock"></i> Signout Time</span>
                                <span><i class="fa fa-location-arrow"></i> Signout Distance</span>
                            </p>
                            <p class="flex_div attend_his_data_label_data attend_his_data_label_text">
                                <span>10-08-2023</span>
                                <span>6:00</span>
                                <span>9.20 Meter</span>
                            </p>
                            <p class="attend_his_data_office">
                                <span><i class="fa fa-building"></i> GRATIA</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
{{-- </div>
</div> --}}

{{-- New Design --}}


<div class="flex_div main_attend_his_div">
    <form action="history_export" method="post" class="flex_div attend_select_div" id="attend_his_from_id">
        @csrf
        <div class="flex_div attend_select_div_1">
            <p>From :</p>
            <input type="date" name="his_from" id="his_from">
        </div>
        <div class="flex_div attend_select_div_1">
            <p>To :</p>
            <input type="date" name="his_to" id="his_to">
        </div>
        <div class="flex_div attend_select_div_1 attend_select_btn_div">
            <p style="opacity:0"></p>
            <button type="button" id="attend_his_export_btn"><i class="fa fa-search"></i></button>
        </div>
        <div class="flex_div attend_select_export_div">
            <button type="submit" class="his_export_btn"><i class="fa fa-download"></i></button>
        </div>
    </form>
    <div class="flex_div main_attend_his_div_1">
        <div class="flex_div attend_his_head_div">
            <p class="attend_his_head_para attend_his_date"><i class="fa fa-calendar-day"></i> Date</p>
            <p class="attend_his_head_para attend_his_time"><i class="fa fa-clock"></i> Login Time</p>
            <p class="attend_his_head_para attend_his_meter"><i class="fa fa-location-arrow"></i> Log Distance</p>
            <p class="attend_his_head_para attend_his_time"><i class="fa fa-clock"></i> Logout Time</p>
            <p class="attend_his_head_para attend_his_meter"><i class="fa fa-location-arrow"></i> Logout Distance</p>
            <p class="attend_his_head_para attend_his_office"><i class="fa fa-building"></i> Login Office</p>
            <p class="attend_his_head_para attend_his_office"><i class="fa fa-building"></i> Logout Office</p>
        </div>
        <div class="flex_div main_attend_his_data">
            {{-- <div class="flex_div attend_is_data">
                <p class="attend_his_data_p attend_his_date">10-08-2023</p>
                <p class="attend_his_data_p attend_his_time">10:30</p>
                <p class="attend_his_data_p attend_his_meter">6.80 Meter</p>
                <p class="attend_his_data_p attend_his_time">12:22</p>
                <p class="attend_his_data_p attend_his_meter">3.80 Meter</p>
                <p class="attend_his_data_p attend_his_office">HRMS</p>
                <p class="attend_his_data_p attend_his_office">GRATIA</p>
            </div>
            <div class="flex_div attend_is_data">
                <p class="attend_his_data_p attend_his_date">11-08-2023</p>
                <p class="attend_his_data_p attend_his_time">11:30</p>
                <p class="attend_his_data_p attend_his_meter">3.80 Meter</p>
                <p class="attend_his_data_p attend_his_time">13:22</p>
                <p class="attend_his_data_p attend_his_meter">3.80 Meter</p>
                <p class="attend_his_data_p attend_his_office">HRMS</p>
                <p class="attend_his_data_p attend_his_office">GRATIA</p>
            </div> --}}
        </div>
    </div>
</div>
