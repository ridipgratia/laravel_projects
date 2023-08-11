<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employe Registration Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=REM&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_registration.css') }}">
</head>

<body>
    <div class="flex_div head_div">
        <span>A</span>
        <a href="registration">New Registration</a>
    </div>
    <div class="flex_div main_deg_div">
        <p class="arrow" id="right">
            < </p>
                <div class="designation_div" onscroll="fun()">
                    @php
                        $count = count($designations);
                    @endphp
                    @for ($i = 0; $i < $count; $i++)
                    <div class="flex_div deg_div">
                        <p>{{ $designations[$i]->designation_name }}</p>
                        <span class="icon"><i class="fa fa-pen-nib"></i></span>
                        <p class="icon_num"><span>{{ $count_designations[$i] }}</span></p>
                    </div> @endfor
                    
                </div>
                <p class="arrow"
        id="left">></p>
    </div>

    {{-- Set DataTable For Show Data --}}

    <div class="main_table">


        <table id="users-table" class="display" style="width: 90%;">
            <thead>
                <th>
                    SI NO
                </th>
                <th>
                    Code
                </th>
                <th>
                    Full Name
                </th>
                <th>
                    Designation
                </th>
                <th>
                    Phone No
                </th>
                <th>
                    Email ID
                </th>
                <th data-orderable="false">
                    Action
                </th>
            </thead>
            <tbody id="table_body">

            </tbody>
        </table>
    </div>

    {{-- Emplote Details Layout Included  --}}

    @include('layout.details')

    {{-- Exloye File SHow Layout Included  --}}

    @include('layout.show_file')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/admin_registration.js') }}"></script>
    </body>

</html>
