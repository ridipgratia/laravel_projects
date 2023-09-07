<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Info</title>
    @include('links.fonts')
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/side_nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user_info.css') }}">
</head>

<body>
    <div class="flex_div main_body">
        <x-side>
        </x-side>
        <div class="flex_div main_div">
            <div class="flex_div user_info_div">
                <div class="flex_div user_basic_div">
                    <x-user_basic_info :userInfo=$user_info>
                    </x-user_basic_info>

                    <x-change-password>
                    </x-change-password>

                    {{-- <x-Password-reset>
                    </x-Password-reset> --}}

                </div>
                <div class="flex_div user_basic_div_1">
                    <x-user-side-info :userSideInfo=$user_info>
                    </x-user-side-info>
                </div>
            </div>
        </div>
    </div>
    @include('links.link_1')
    <script src="{{ asset('js/user_info/password_reset.js') }}"></script>
    <script src="{{ asset('js/user_info/change_password.js') }}"></script>
    {{-- <script src="{{ asset('js/user_info/user_side_info.js') }}"></script> --}}
</body>
<script>
    function check_input_type(index) {
        if ($('.pass_int').eq(index).attr('type') == "password") {
            $('.pass_int').eq(index).attr('type', 'text');
        } else {
            $('.pass_int').eq(index).attr('type', 'password');
        }
    }
</script>

</html>
