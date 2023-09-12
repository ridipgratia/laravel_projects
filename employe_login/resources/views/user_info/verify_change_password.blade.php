<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Change Password </title>
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/verify_change_password.css') }}">
</head>

<body>
    <div class="flex_div main_verify_div">
        <div class="flex_div verify_div">
            <img src="{{ asset('images/envalop.png') }}" class="verify_email_image" alt="">
            <h1>Verify Change Password By Email</h1>
            <p>Your Change Password Request Is {{ $status }} .</p>
            <p>Verification Details : {{ $message }} .</p>
            <div class="flex_div verify_div_1">
                <a href="/user_info">Home</a><br>
                <a href="{{ route('logout') }}">Logout </a>
            </div>
        </div>
    </div>
</body>

</html>
