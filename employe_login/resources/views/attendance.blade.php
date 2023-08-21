<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    @include('links.fonts')
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/side_nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <title>Document</title>
</head>

<body>
    {{-- @if ($atten_button != 'sign_out')
        <div class="location_div">
            <button id="location_btn" value="pnrd">PNRD</button>
            <button id="location_btn" value="gratia">Gratia</button>
        </div>
    @endif

    <div id="div">
        <button id="{{ $atten_button }}">{{ str_replace('_', ' ', $atten_button) }}</button>
    </div>
    <textarea name="" id="text" id="" cols="30" rows="10" style="display:none;"></textarea> --}}


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
        </div>
    </div>
    @include('layouts.attendance.locatins')
    @include('layouts.attend_submit_modal')
    @include('links.link_1')
    {{-- <script src="{{ asset('js/attendance/atten.js') }}"></script> --}}
    <script src="{{ asset('js/attendance/submit_attendance.js') }}"></script>
    <script src="{{ asset('js/attendance/location_attendance.js') }}"></script>
    <script src="{{ asset('js/attendance/final_attendance.js') }}"></script>
</body>

</html>
