<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/view_employe.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="flex_div employe_div">
        <div class="flex_div employe_div_1">
            <div class="flex_div employe_data_div">
                <p>Employe Code</p>
                <p>Employe Name</p>
                <p>Designation</p>
            </div>
            <div class="flex_div employe_data_div">
                <p>101</p>
                <p>Temp Name</p>
                <p>Web Developer</p>
            </div>
        </div>
        <div class="flex_div child_have_div">
            <div class="flex_div child_have_div_1">
                <p>Do You Have Children ?</p>
                <input type="checkbox" id="child_have" onclick="child_have_fun()">
            </div>
            <form action="/view_employe" method="post" style="display: none;" class="flex_div child_count_form">
                <input type="text" name="child_count" oninput="console.log('gfdghfdgf')"
                    placeholder="How Many Child You Have">
                <button type="submit">Upload Details</button>
            </form>
        </div>
        @for ($i = 0; $i < $child_count; $i++)
            <form action="" method="post" id="form_id_{{ $i }}">
                <input type="text" name="child_name" placeholder="Child Name">
                <input type="file" name="child_file">
                <button type="submit" class="form_btn" value="form_id_{{ $i }}">Upload Details</button>
            </form>
        @endfor

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/view_employe.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.form_btn').on('click', function(event) {
                    event.preventDefault();
                    let id = $(this).val();
                    let id_name = '#' + id;
                    let form_data = new FormData($(id_name)[0]);
                    $.ajax({
                        type: "post",
                        url: "/upload_employe",
                        data: form_data,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            alert(result.message);
                        },
                        error: function(data) {
                            alert("Some Error ");
                        }
                    });
                })
            })
        </script>
</body>

</html>
