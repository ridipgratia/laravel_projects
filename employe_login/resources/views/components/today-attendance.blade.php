@if ($attend_details != null)
    <div class="flex_div today_attend_div_1">
        <div class="flex_div today_attend_div_2">
            <h1 class="today_attend_office">Login</h1>
            <h1 class="today_attend_office">{{ $attend_details[0]->office_name }}</h1>
        </div>
        <div class="flex_div today_attend_div_3">
            <p class="today_attend_text"><span>Date: </span>&nbsp;<span>{{ $attend_details[0]->login_date }}</span></p>
            <p class="today_attend_text"><span>Time: </span>&nbsp;<span>{{ $attend_details[0]->login_time }}</span></p>
            <p class="today_attend_text_1"><span>Distance:
                </span>&nbsp;<span>{{ $attend_details[0]->login_location_diff }} Meters To Office .</span></p>
        </div>
    </div>
    @if ($logout_check == 'yes')
        <div class="flex_div today_attend_div_1">
            <div class="flex_div today_attend_div_2">
                <h1 class="today_attend_office">Logout</h1>
                <h1 class="today_attend_office">{{ $attend_details[0]->logout_location }}</h1>
            </div>
            <div class="flex_div today_attend_div_3">
                <p class="today_attend_text"><span>Date: </span>&nbsp;<span>{{ $attend_details[0]->login_date }}</span>
                </p>
                <p class="today_attend_text"><span>Time: </span>&nbsp;<span>{{ $attend_details[0]->logout_time }}</span>
                </p>
                <p class="today_attend_text_1"><span>Distance:
                    </span>&nbsp;<span>{{ $attend_details[0]->logout_diff }} Meters To Office .</span></p>
            </div>
        </div>
    @endif
    @if ($logout_check == 'no')
        <div class="flex_div today_attend_div_1">
            <div class="flex_div today_attend_div_2">
                <h1 class="today_attend_office">Logout</h1>
                <h1 class="today_attend_office">Waiting...</h1>
            </div>
            <div class="flex_div today_attend_div_3">
                <p class="today_attend_text"><span>Date: </span>&nbsp;<span>Waiting...</span>
                </p>
                <p class="today_attend_text"><span>Time:
                    </span>&nbsp;<span>Waiting...</span>
                </p>
                <p class="today_attend_text_1"><span>Distance:
                    </span>&nbsp;<span>Waiting... Meters To Office .</span></p>
            </div>
        </div>
    @endif
@endif
