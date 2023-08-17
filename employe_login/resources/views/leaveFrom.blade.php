<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links.fonts')
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/side_nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaveFrom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <title>Leave From</title>
</head>

<body>
    <div class="flex_div main_body">
        <x-side>
        </x-side>
        <div class="flex_div main_div">

            <div class="flex_div leave_form_div">
                <div class="flex_div leave_head_div">
                    <h1>Employe Leave System</h1>
                    <p><i class="fa fa-user"></i></p>
                </div>
                <form method="post" class="flex_div leaveFrom" id="leave_form" enctype="multipart/form-data">
                    @csrf
                    <div class="flex_div leave_div">
                        <p>Select Leave Type</p>
                        <select name="typeOfLeave" id="type_leave">
                            <option value="Select" selected disabled>Select</option>
                            @foreach ($type_of_leave as $leave)
                                @if ($leave->id !== 3)
                                    <option value="{{ $leave->id }}">{{ $leave->leave_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="flex_div leave_div">
                        <p>Select Day Type</p>
                        <select name="typeOfDay" id="">
                            <option value="Select" selected disabled>Select</option>
                            @foreach ($type_of_day as $day)
                                <option value="{{ $day->id }}">{{ str_replace('_', ' ', $day->day_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex_div leave_div">
                        <p>From Date</p>
                        <input type="date" name="from_date">
                    </div>
                    <div class="flex_div leave_div">
                        <p>To Date</p>
                        <input type="date" name="to_date">
                    </div>
                    <div class="flex_div leave_div leave_reason">
                        <p>Give A Reason For Your Leave</p>
                        <textarea name="reason"></textarea>
                    </div>
                    <div class="flex_div leave_file_div">
                        <input type="file" name="file" class="file_input" id="medical_file" style="display: none;"
                            accept=".jpg,.pdf,.jpeg,.png">
                    </div>
                    <div class="flex_div leave_btn_div">
                        <button id="leave_form_id">Request Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('links.link_1')
    <script src="{{ asset('js/leaveFrom.js') }}"></script>
</body>

</html>
