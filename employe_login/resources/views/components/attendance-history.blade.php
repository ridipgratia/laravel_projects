<div class="flex_div main_attend_his_div">
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
        </form>
        <div class="flex_div attend_his_data_div">
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
        </div>
    </div>
</div>
