<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leave_approved.css') }}">
    <link rel="stylesheet" href="{{ asset('css/section.css') }}">

    <title>Leave Approved Section</title>
</head>

<body>
    <div class="flex_div admin_section_div">
        @include('section', [
            'class_name' => 'section_2',
            'head_name' => 'Leave Approval Section',
            'number' => 'wait',
            'icon' => 'fa fa-check',
            'link' => 'admin_leave',
        ])
        @include('section', [
            'class_name' => 'section_1',
            'head_name' => 'Leave Approved Section',
            'number' => 'wait',
            'icon' => 'fa fa-thumbs-up',
            'link' => 'leave_approved',
        ])
        @include('section', [
            'class_name' => 'section_3',
            'head_name' => 'Leave Rejected Section',
            'number' => 'wait',
            'icon' => 'fa fa-window-close',
            'link' => 'leave_rejected',
        ])
    </div>
    <h1 class="head_text">ADMIN LEAVE APPROVAL SYSTEM</h1>
    <div class="flex_div main_div">
        <div class="flex_div leave_div" style="background:#4A6C82;">
            <p class="leave_para leave_para_7">SI NO</p>
            <p class="leave_para leave_para_1">E.ID</p>
            <p class="leave_para leave_para_2">Name</p>
            <p class="leave_para leave_para_3">Designation</p>
            <p class="leave_para leave_para_4">Leave Type</p>
            <p class="leave_para leave_para_5">Form Date</p>
            <p class="leave_para leave_para_6">To Date</p>
            <button class="leave_button" style="opacity: 0;">View</button>
        </div>
        @php
            $i = 0;
        @endphp
        @foreach ($leave_data as $data)
            @php
                $i++;
            @endphp
            @include('layout.approval_data',['i'=>$i,'e_id'=>$data->e_id,
            'employe_name'=>$data->employe_name,
            'designation_name'=>$data->designation_name,
            'leave_name'=>$data->leave_name,
            'form_date'=>$data->form_date,
            'to_date'=>$data->to_date,
            'id'=>$data->id]) @endforeach
    </div>
    @include('layout.modal_1', ['action' => 'none']);
    @include('layout.modal_2')
    <script script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/admin_leave.js') }}"></script>
    <script src="{{ asset('js/section.js') }}"></script>
</body>

</html>
