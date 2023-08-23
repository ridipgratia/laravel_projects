<div class="flex_div recent_attend_div">
    <div class="flex_div load_recent_div">
        <img src="{{ asset('images/loader_1.gif') }}" alt="">
    </div>
    <h1>Last Day Attendance History</h1>
    <div class="flex_div recent_attend_div_1">
        <p>Select Last Attendance Date </p>
        <input type="date" id="recent_date">
    </div>
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
        <div class="flex_div today_attend_div_1 attend_history_div">
            <div class="flex_div today_attend_div_2 attend_history_div_1">
                <h1 class="today_attend_office">Logout</h1>
                <h1 class="today_attend_office last_day_office">{{ $last_day_data[0]->office_name }}</h1>
            </div>
            <div class="flex_div today_attend_div_3 attend_history_div_2">
                <p class="today_attend_text"><span>Date: </span>&nbsp;<span
                        class="last_day_text">{{ $last_day_data[0]->login_date }}</span>
                </p>
                <p class="today_attend_text"><span>Time: </span>&nbsp;<span
                        class="last_day_text">{{ $last_day_data[0]->logout_time }}</span>
                </p>
                <p class="today_attend_text_1"><span>Distance:
                    </span>&nbsp;<span class="last_day_text">{{ $last_day_data[0]->logout_diff }} Meters To Office
                        .</span></p>
            </div>
        </div>
    </div>
</div>
