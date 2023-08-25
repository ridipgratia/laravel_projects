<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links.fonts')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/side_nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <title>Home Dashboard</title>
</head>

<body>
    <div class="flex_div main_body">
        <x-side>
        </x-side>
        <div class="flex_div main_div">
            <div class="flex_div submit_attend">
                <div class="flex_div submit_attend_div">
                    <p class="flex_div "><span><i class="fa fa-calendar-day"></i></span><span><i
                                class="fa fa-calendar-day"></i></span></p>
                </div>
                <div class="flex_div submit_attend_div_1">
                    <p class="flex_div submit_attend_text submit_attend_time">{{ $date[0] }}</p>
                    <p class="flex_div submit_attend_text submit_attend_date">
                        <span>{{ $date[1] }}</span><span>{{ $date[2] }}</span>
                    </p>
                </div>
            </div>
            <div class="flex_div submit_attend_1">
                <button class="flex_div submit_attend_btn " id="{{ $atten_button[0] }}">
                    <span><i class="fa fa-hand-pointer"></i></span>
                    <span>{{ $atten_button[1] }}</span>
                </button>
            </div>
            <div class="flex_div today_attend_div">
                <x-today-attendance>
                </x-today-attendance>
            </div>
        </div>
    </div>
    @include('layouts.attendance.locatins')
    @include('layouts.attend_submit_modal')
    @include('layouts.attendance.final_logout')
    @include('links.link_1')
    <script src="{{ asset('js/attendance/submit_attendance.js') }}"></script>
    <script src="{{ asset('js/attendance/location_attendance.js') }}"></script>
    <script src="{{ asset('js/attendance/final_attendance.js') }}"></script>
</body>

</html>
