<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=REM&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <title>registration Form</title>
</head>

<body>
    <div class="flex_div step_div">
        <div class="flex_div step_div_2">
            <div class="flex_div step_div_1">
                1. Basic Details
                @include('layout.step_icon')
            </div>
            <div class="flex_div step_div_1">
                2. Education Details
                @include('layout.step_icon')
            </div>
            <div class="flex_div step_div_1">
                3. Expirience Details
                @include('layout.step_icon')
            </div>
        </div>

    </div>
    <div class="flex_div registration_div">
        <form action="" method="post" class="flex_div registration_form" id="registration_form_id" enctype="multipart/form-data">
            @csrf
            <table class="flex_div registration_div_1 ani_1" id="reg_1">
                <tr class="flex_div registration_tr">
                    <td class="flex_div registration_td" style="width: 97%;">
                        <h1> Basic Details</h1>
                    </td>
                    <td class="flex_div registration_td">
                        <p>Employe Code </p>
                        <input type="text" name="emp_code">
                    </td>
                    <td class="flex_div registration_td">
                        <p> Full Name</p>
                        <input type="text" name="emp_name">
                    </td>
                    <td class="flex_div registration_td">
                        <p> Father name</p>
                        <input type="text" name="emp_father">
                    </td>
                    <td class="flex_div registration_td">
                        <p> Mother name</p>
                        <input type="text" name="emp_mother">
                    </td>
                    <td class="flex_div registration_td">
                        <p> Gender</p>
                        <select name="emp_gender" id="">
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->gender }}</option> @endforeach
                        </select>
                    </td>
                    <td class="flex_div
        registration_td">
    <p> Designation</p>
    <select name="emp_designation" id="">
        <option value="Select" selected disabled>Select</option>
        @foreach ($designations as $designation)
            <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
        @endforeach
    </select>
    </td>
    <td class="flex_div
        registration_td">
        <p>Date Of Birth</p>
        <input type="date" name="date_of_birth">
    </td>
    <td class="flex_div
        registration_td">
        <p>Date of Joining</p>
        <input type="date" name="emp_join_date">
    </td>
    <td class="flex_div registration_td">
        <p> Phone No</p>
        <input type="number" name="emp_phone">
    </td>
    <td class="flex_div registration_td">
        <p> Email ID</p>
        <input type="email" name="emp_email">
    </td>
    <td class="flex_div registration_td">
        <p> Blood Group </p>
        <select name="blood_group" id="">
            <option value="Select" selected disabled>Select</option>
            @foreach ($blood_groups as $blood_group)
                <option value="{{ $blood_group->id }}">{{ $blood_group->blood_name }}</option>
            @endforeach
        </select>
    </td>
    <td class="flex_div registration_td">
        <p> Bank Name</p>
        <input type="text" name="emp_bank_name">
    </td>
    <td class="flex_div registration_td">
        <p> Account No</p>
        <input type="number" name="emp_account_no">
    </td>
    <td class="flex_div registration_td">
        <p> IFSC Code</p>
        <input type="text" name="emp_ifsc_code">
    </td>
    <td class="flex_div registration_td">
        <p> Brance Name</p>
        <input type="text" name="emp_brance_name">
    </td>
    <td class="flex_div registration_td">
        <p style="opacity: 0">sa</p>
        <button type="button" id="form_btn_1" value="1">Next <i class="fa fa-arrow-right"></i></button>
    </td>
    </tr>
    </table>

    {{-- Error message for Form 1 --}}
    @include('layout.modal_1')

    <table class="flex_div registration_div_1 ani_1" id="reg_2">
        <tr class="flex_div registration_tr">
            <td class="flex_div registration_td_1" style="width: 97%">
                <h1 class="reg_head"> Education Details</h1>
            </td>
        </tr>
        <tr class="flex_div registration_tr_1 education_tab">
            <td class="flex_div  registration_td_1 " style="width: 97%">
                <span class="count_education">1</span>
                <span></span>
            </td>
            <td class="flex_div registration_td">
                <p>Board Name </p>
                <input type="text" name="emp_board_name[]">
            </td>
            <td class="flex_div registration_td">
                <p>Degree Name </p>
                <input type="text" name="emp_degree[]">
            </td>
            <td class="flex_div registration_td">
                <p>School Or College </p>
                <input type="text" name="emp_school[]">
            </td>
            <td class="flex_div registration_td">
                <p>Passing Year</p>
                <input type="number" name="emp_passing_year[]">
            </td>
            <td class="flex_div registration_td">
                <p>Percentage</p>
                <input type="number" name="emp_percentage[]">
            </td>
            <td class="flex_div registration_td">
                <p>Marks</p>
                <input type="number" name="emp_marks[]">
            </td>
            <td class="flex_div registration_td">
                <p>Certificate</p>
                <input type="file" name="emp_education_file[]" style="border: none">
            </td>
        </tr>
        <tr class="flex_div registration_tr_2">
            <td class="flex_div registration_td" style="width: 100%">
                <button type="button" id="add_education">Add <i class="fa fa-plus" aria-hidden="true"></i></button>
            </td>
        </tr>
        <tr class="flex_div registration_tr">
            <td class="flex_div registration_td">
                <button type="button" id="prev_btn_1" onclick="prev_fun(reg_1,reg_2,0)"><i
                        class="fa fa-arrow-left"></i> Prev</button>
            </td>
            <td class="flex_div registration_td">
                <button type="button" id="form_btn_1" value="2">Next <i class="fa fa-arrow-right"></i> </button>
            </td>
        </tr>
    </table>
    <table class="flex_div registration_div_1 ani_1" id="reg_3">
        <tr class="flex_div registration_tr">
            <td class="flex_div registration_td_1" style="width: 97%">
                <h1 class="reg_head"> Expirience Details</h1>
            </td>
        </tr>
        <tr class="flex_div registration_tr_1 company_tab">
            <td class="flex_div registration_td_1" style="width: 97%">
                <span class="count_company">1</span>
                <span></span>
            </td>
            <td class="flex_div registration_td">
                <p>Company Name </p>
                <input type="text" name="emp_com_name[]">
            </td>
            <td class="flex_div registration_td">
                <p>Form Date</p>
                <input type="date" name="emp_form_date[]">
            </td>
            <td class="flex_div registration_td">
                <p>To Date</p>
                <input type="date" name="emp_to_date[]">
            </td>
            <td class="flex_div registration_td">
                <p>Job Role </p>
                <input type="text" name="emp_role[]">
            </td>
            <td class="flex_div registration_td">
                <p>Expirience Certificate</p>
                <input type="file" name="emp_ex_certificate[]" style="border: none">
            </td>
        </tr>
        <tr class="flex_div registration_tr_2">
            <td class="flex_div registration_td" style="width: 100%">
                <button type="button" id="add_company">Add <i class="fa fa-plus" aria-hidden="true"></i></button>
            </td>
        </tr>
        <tr class="flex_div registration_tr">
            <td class="flex_div registration_td">
                <button type="button" id="prev_btn_1" onclick="prev_fun(reg_2,reg_3,1)"><i
                        class="fa fa-arrow-left"></i> Prev</button>
            </td>
            <td class="flex_div registration_td">
                <button type="button" id="form_btn_1" value="3">Submit <i class="fa fa-arrow-right"></i>
                </button>
            </td>
        </tr>
        </form>
        </div>
        <input type="hidden" name="count_verify">
        <script script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
        </script>
        <script src="{{ asset('js/registration.js') }}"></script>
        </body>

</html>
