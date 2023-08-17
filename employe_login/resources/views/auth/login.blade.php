<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/class.css') }}"> --}}
    <link rel="stylesheet" href="css/class.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/employe_login.css') }}"> --}}
    <link rel="stylesheet" href="css/employe_login.css">

    <title>Employe Login</title>
    <style>
        * {
            font-family: 'Roboto', sans-serif !important;
        }
    </style>

</head>

<body>

    <div class="flex_div main_login_div">
        <x-auth-validation-errors :errors="$errors" />
        <div class="flex_div login_div">

            <form action="{{ route('login') }}" method="post" class="flex_div">
                @csrf
                <p id="login_head">LOGIN IN</p>
                <p>Your Email ID: </p>
                <div class="flex_div login_int login_email">
                    <span><i class="fa fa-user"></i></span>
                    <input type="text" name="email">
                </div>
                <p>Your Password: </p>
                <div class="flex_div login_int login_pass">
                    <span><i class="fa fa-lock"></i></span>
                    <input type="password" id="password" name="password">
                    <span onclick="toggle_password()"><i class="fa fa-eye"></i></span>
                </div>
                <div class="flex_div login_btn">
                    <a href="">Forgot <br> Password</a>
                    <button>Log In</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
