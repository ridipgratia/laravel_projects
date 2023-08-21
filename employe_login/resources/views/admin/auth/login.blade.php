<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Playfair+Display:ital@1&display=swap"
        rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{ asset('css/class.css') }}"> --}}
    <link rel="stylesheet" href="../css/class.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}"> --}}
    <link rel="stylesheet" href="../css/admin_login.css">
    <link rel="stylesheet" href="../css/media.css">

    <title>Admin Login To Employe System</title>
    <style>
    </style>

</head>

<body>

    <div class="flex_div login_div">
        {{-- <x-auth_admin_validation_error :errors="$errors" /> --}}
        <form action="{{ route('admin.login') }}" method="post" class="flex_div login_form">
            @csrf
            <h1>Admin Login</h1>
            <p class="circle_icon"><i class="fa fa-user"></i></p>
            <p>Email ID</p>
            <div class="flex_div login_div_1">
                <span><i class="fa fa-user"></i></span>
                <input type="text" name="email" placeholder="Type Your Email ID">
            </div>
            <p>Password</p>
            <div class="flex_div login_div_1">
                <span><i class="fa fa-lock"></i></span>
                <input type="password" name="password" placeholder="Type Your Password">
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

    <script>
        $('#image_modal').modal('show');
    </script>
</body>

</html>
