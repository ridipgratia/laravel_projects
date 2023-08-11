<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaveProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <title>Leave Profile</title>
</head>

<body>
    <div class="flex_div header_div">
        <p>Ridip Goswami</p>
        <p>Web Developer</p>
        <a href=""><i class="fas fa-sign-out-alt"></i></a>
    </div>
    <div class="flex_div main_div">
        @php
        $i=0;
        @endphp
        @foreach ($type_of_leave as $leaves)
        <div class="flex_div leave_div">
            <div class="flex_div leave_div_1">
                <p>Leave Name</p>
                <p>{{ $leaves->leave_name }}</p>
            </div>
            <div class="flex_div leave_div_1">
                <p>Total Leave</p>
                <p>{{ $leaves->day_on_leave }}</p>
            </div>
            <div class="flex_div leave_div_1">
                <p>Remaining Leave</p>
                <p>{{ $leave_allocation[$i]->leave_balance }}</p>
            </div>
            <div class="flex_div  leave_div_2">
                <a href="leaveFrom">Apply Leave <i class="fa fa-paper-plane icon"></i></a>
            </div>
            @php
                $i++;

            @endphp
        </div> @endforeach
        
    </div>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
</body>

</html>
