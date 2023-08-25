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
    <link rel="stylesheet" href="{{ asset('css/attend_his.css') }}">
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
            <x-attendance-chart :present=$attend_chart>
            </x-attendance-chart>
            <x-recent-attendane>
            </x-recent-attendane>
            <x-attendance-history>
            </x-attendance-history>
        </div>
    </div>

    @include('links.link_1')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    {{-- <script src="{{ asset('js/attendance/atten.js') }}"></script> --}}
    <script src="{{ asset('js/attendance/recent_attend.js') }}"></script>
    <script>
        var attend_chart = @json($attend_chart);
    </script>
    <script src="{{ asset('js/attendance/attendance_chart.js') }}"></script>
    <script src="{{ asset('js/attendance/attend_his.js') }}"></script>

</body>

</html>
