<div class="flex_div recent_attend_div">
    <div class="flex_div load_recent_div">
        <img src="{{ asset('images/loader_1.gif') }}" alt="">
    </div>
    <h1>Last Day Attendance History</h1>
    <form action="/export_1" method="post" class="flex_div recent_attend_div_1">
        @csrf
        <p>Select Last Attendance Date </p>
        <input type="date" id="recent_date" name="recent_date">
        <button id="export_attend_btn"><span>Export Attendance Report</span><span><i
                    class="fa fa-arrow-down"></i></span></button>
    </form>
    {{-- <a href="/export_1" id="export_attend_btn"><span>Export Attendance Report</span><span><i
                    class="fa fa-arrow-down"></i></span></a> --}}
    @if ($is_emp_new != null)
        <div class="flex_div recent_attend_div_2">
            <div class="flex_div today_attend_div_1 attend_history_div">
                <div class="flex_div today_attend_div_2 attend_history_div_1">
                    <h1 class="today_attend_office">Login</h1>
                    <h1 class="today_attend_office last_day_office">{{ $last_day_data[0]->office_name }}</h1>
                </div>
                <div class="flex_div today_attend_div_3 attend_history_div_2">
                    <p class="today_attend_text "><span>Date: </span>&nbsp;<span
                            class="last_day_text">{{ $last_day_data[0]->login_date }}</span>
                    </p>
                    <p class="today_attend_text"><span>Time: </span>&nbsp;<span
                            class="last_day_text">{{ $last_day_data[0]->login_time }}</span>
                    </p>
                    <p class="today_attend_text_1"><span>Distance:
                        </span>&nbsp;<span class="last_day_text">{{ $last_day_data[0]->login_location_diff }} Meters To
                            Office .</span></p>
                </div>
            </div>
            @if ($check_logout == 'yes')
                <div class="flex_div today_attend_div_1 attend_history_div">
                    <div class="flex_div today_attend_div_2 attend_history_div_1">
                        <h1 class="today_attend_office">Logout</h1>
                        <h1 class="today_attend_office last_day_office">{{ $last_day_data[0]->logout_location }}</h1>
                    </div>
                    <div class="flex_div today_attend_div_3 attend_history_div_2">
                        <p class="today_attend_text"><span>Date: </span>&nbsp;<span
                                class="last_day_text">{{ $last_day_data[0]->login_date }}</span>
                        </p>
                        <p class="today_attend_text"><span>Time: </span>&nbsp;<span
                                class="last_day_text">{{ $last_day_data[0]->logout_time }}</span>
                        </p>
                        <p class="today_attend_text_1"><span>Distance:
                            </span>&nbsp;<span class="last_day_text">{{ $last_day_data[0]->logout_diff }} Meters To
                                Office
                                .</span></p>
                    </div>
                </div>
            @else
                <div class="flex_div today_attend_div_1 attend_history_div recent_logout_div" style="display: none">
                    <div class="flex_div today_attend_div_2 attend_history_div_1">
                        <h1 class="today_attend_office">Logout</h1>
                        <h1 class="today_attend_office last_day_office">Waiting</h1>
                    </div>
                    <div class="flex_div today_attend_div_3 attend_history_div_2">
                        <p class="today_attend_text"><span>Date: </span>&nbsp;<span class="last_day_text">Waiting</span>
                        </p>
                        <p class="today_attend_text"><span>Time: </span>&nbsp;<span class="last_day_text">Waiting</span>
                        </p>
                        <p class="today_attend_text_1"><span>Distance:
                            </span>&nbsp;<span class="last_day_text">Waiting Meters To
                                Office
                                .</span></p>
                    </div>
                </div>
            @endif

        </div>
    @endif

</div>
