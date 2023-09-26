<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Delay Compensation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/side_nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">

            {{-- Side Navbar Layout  --}}


            @include('layouts.sidenav')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <button class="btn btn-primary d-md-none fs-2 mb-3" id="sidebarToggle"><i
                        class="fa-solid fa-bars"></i></button>
                {{-- Header Layout  --}}

                @include('layouts.header')
                <form class="w-75 m-auto mt-4" id="add_delay_form">
                    @csrf
                    <h2 class="text-center mb-4" style="font-size: 24px;text-transform: uppercase">Add Delay
                        Compensation
                    </h2>
                    <div class="form-group mb-3">
                        <label for="firstName">Enter Work Code Number:</label>
                        <input type="text" class="form-control" name="code_number"
                            placeholder="Enter Work Code Number">
                    </div>
                    <div class="form-group mb-3">
                        <label for="lastName">Enter MR Number:</label>
                        <input type="text" class="form-control" name="mr_number" placeholder="Enter MR Number">
                    </div>
                    <div class="form-group mb-3">
                        <label>Person & Designation responsible for Delay:</label>
                        <div class="row flex gap-2">
                            <input type="text" class="form-control col" name="person_delay"
                                placeholder="Person responsible for Delay">
                            <input type="text" class="form-control col" name="designation_delay"
                                placeholder="Designation responsible for Delay">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Recovered Ammount:</label>
                        <input type="number" class="form-control" name="recover_amount"
                            placeholder="Recovered Ammount">
                    </div>
                    <div class="form-group mb-3">
                        <label>Date on which amount is recovered:</label>
                        <input type="date" class="form-control date_class" name="date_recover_amount"
                            placeholder="Date on which amount is recovered">
                    </div>
                    <div class="form-group mb-3">
                        <label>Date on which deposited to the bank:</label>
                        <input type="date" class="form-control date_class" name="date_deposite_bank"
                            placeholder="Date on which deposited to the bank">
                    </div>
                    <div class="form-group mb-3">
                        <label>PDF of bank statement:</label>
                        <input type="file" class="form-control" name="bank_statement"
                            placeholder="PDF of bank statement" accept="application/pdf">
                    </div>
                    <!-- Add more input fields as needed -->
                    <button type="submit" id="add_delay_form_btn" class="btn btn-primary">Submit</button>
                </form>
            </main>
        </div>
    </div>
    <script script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/add_delay.js') }}"></script>
    <script src="{{ asset('js/sidenav.js') }}"></script>
</body>

</html>
