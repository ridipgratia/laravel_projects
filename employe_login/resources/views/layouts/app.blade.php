<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <!-- Scripts -->

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="flex_div main_dash_div">
            <div class="flex_div main_dash_div_1">
                <div class="flex_div side_dash_div">
                    <div class="flex_div side_profile_div">
                        {{ $emp_name }}
                        {{ $login_emp_code }}
                        <p class="side_profile_p">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="flex_div menu_icon_div">
                        <button onclick="menu_btn_fun()"><i class="fa fa-bars"></i></button>
                    </div>
                    <div class="flex_div side_nav_div">
                        <button value="{{ Auth::user()->e_id }}" class="flex_div side_nav_p" id="basic_btn"><span><i
                                    class="fa fa-info"></i> </span>
                            <span>Basic
                                Details</span></button>
                        <button value="{{ Auth::user()->e_id }}" class="flex_div side_nav_p"
                            id="education_btn"><span><i class="fa fa-graduation-cap"></i>
                            </span>
                            <span>Educational
                                Details</span>
                        </button>
                        <button value="{{ Auth::user()->e_id }}" class="flex_div side_nav_p"
                            id="expirience_btn"><span><i class="fa fa-building"></i>
                            </span>
                            <span>Expirience
                                Details</span>
                        </button>
                        <button value="{{ Auth::user()->e_id }}" class="flex_div side_nav_p" id="leave_btn"><span><i
                                    class="fas fas-house-leave"></i>
                            </span>
                            <span>Leave
                                Details</span>
                        </button>
                        <a href="home" value="{{ Auth::user()->e_id }}" class="flex_div side_nav_p"
                            id="leave_btn"><span><i class="fa fa-home" aria-hidden="true"></i>
                            </span>
                            <span>Home </span>
                        </a>
                    </div>
                </div>
                <div class="flex_div details_div">
                    <div class="flex_div details_head_div">
                        <h1 class="details_head">Basic Details</h1>
                        <a href="{{ route('logout') }}">Log Out &nbsp;&nbsp; <i class="fas fa-sign-out-alt"></i> </a>
                    </div>
                    {{ $header_content }}
                    {{ $basic }}
                    @include('layouts.education')
                    @include('layouts.expirience')
                    @include('layouts.leave')
                    <x-show-image-file : imageUrl="Image 1">
                    </x-show-image-file>
                </div>
            </div>
        </div>

        {{-- <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main> --}}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
