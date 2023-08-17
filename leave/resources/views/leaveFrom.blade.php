<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('css/class.css') }}"> --}}
    <link rel="stylesheet" href="css/class.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/leaveFrom.css') }}"> --}}
    <link rel="stylesheet" href="css/leaveFrom.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/media.css') }}"> --}}
    <link rel="stylesheet" href="css/media.css">
    <title>Leave From </title>
</head>

<body>
    <div class="flex_div main_div">
        <form method="post" class="flex_div leaveFrom" id="leave_form" enctype="multipart/form-data">
            @csrf
            <h1>Employe Leave From</h1>
            <div class="flex_div leaveFrom_1">
                <p class="head_text">Ridip Goswami</p>
                <p class="head_text">Web Developer</p>
            </div>
            <div class="flex_div leaveFrom_1">
                <p>Select Leave Type</p>
                <p>Select Day Type</p>
                <select name="typeOfLeave" id="type_leave">
                    <option value="Select" selected>Select</option>
                    @foreach ($type_of_leave as $leave)
                        <option value="{{ $leave->id }}">{{ $leave->leave_name }}</option>
                    @endforeach
                </select>
                <select name="typeOfDay" id="">
                    <option value="Select" selected>Select</option>
                    @foreach ($type_of_day as $day)
                        <option value="{{ $day->id }}">{{ str_replace('_', ' ', $day->day_name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex_div leaveFrom_1">
                <p>From Date </p>
                <p>To Date</p>
                <input type="date" name="from_date">
                <input type="date" name="to_date">
            </div>
            <div class="flex_div leaveFrom_1">
                <p>Give A Reason For Your Leave</p>
                <textarea name="reason"></textarea>
            </div>
            <div class="flex_div leaveFrom_1">
                <input type="file" name="file" class="file_input" id="medical_file" style="display: none;"
                    accept=".jpg,.pdf,.jpeg,.png">
            </div>
            <button id="leave_form_id">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#type_leave', function() {
                if ($(this).val() == "2") {
                    $('#medical_file').css('display', 'block');
                } else {
                    $('#medical_file').css('display', 'none');
                }
            })
            $('#leave_form_id').on('click', async function() {
                event.preventDefault();
                let form_data = new FormData($('#leave_form')[0]);
                $(this).attr('disabled', true);
                $(this).css('background', 'grey');
                await $.ajax({
                    type: "post",
                    url: "{{ route('leave_form_post_1') }}",
                    // url: "{{ route('leave_controller_post') }}",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        if (result.status == 200) {
                            Swal.fire(
                                'Done',
                                result.message,
                                result.type
                            );
                        } else {
                            Swal.fire(
                                'Error',
                                result.message,
                                'error'
                            );
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
                $(this).attr('disabled', false);
                $(this).css('background', 'rgb(35, 43, 78)');
            });
        })
    </script>
</body>

</html>
