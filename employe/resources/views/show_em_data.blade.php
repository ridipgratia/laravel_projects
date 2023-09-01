<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    {{-- <link rel="stylesheet" href="css/class.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/show_em_data.css') }}">
    {{-- <link rel="stylesheet" href="css/show_em.data.css"> --}}
    {{-- <link rel="stylesheet" href="css/media.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <title>Show Employe Data</title>
</head>

<body>
    <div class="flex_div main_div">
        <div class="flex_div header_title_div">
            <p class="header_title_para">District Name</p>
            <p class="header_title_para" style="font-family: 'Courier New', Courier, monospace">
                Kamrup</p>
        </div>
        <div class="flex_div header_title_div">
            <p class="header_title_para">Block Names</p>
            <p>
                <select name="block_name" id="block_name" class="header_title_select">
                    <option value="all_block" selected>
                        Select
                    </option>
                    @foreach ($block_names as $block_name)
                        <option value="{{ $block_name->block_id }}">{{ $block_name->block_name }}</option> @endforeach
                </select>
            </p>
        </div>
            <div class="flex_div
        header_title_div">
    <p class="header_title_para">GP Name</p>
    <p id="gp_name_para">
        <select name="gp_name" id="gp_name" class="header_title_select">
            <option value="all_gp" selected>Select</option>
        </select>
    </p>
    </div>
    <button class="search_icon" id="employe_search"><i class="fa fa-search" aria-hidden="true"></i>
    </button>

    </div>

    <div class="main_table">

        <table id="users-table" class=" display" style="width: 90%">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        District
                    </th>
                    <th>
                        Block
                    </th>
                    <th>
                        GP
                    </th>
                    <th data-orderable="false">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="table_body">

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">REVIEW CHILD DETAILS</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-window-close" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body modal-body_1 ">
                    {{-- <div class="flex_div content_div">
                        <div class="flex_div content_para_div">
                            <p class="flex_div content_para"><span>Child 1</span></p>
                            <p class="flex_div content_para_1"><span>Name</span><span>Ridip
                                    Goswami</span></p>
                            <p class="flex_div content_para_1"><span>D.O.B</span><span>11-02-1999</span></p>
                            <p class="flex_div content_para_1"><span>School/College</span><span>SBMS</span></p>
                            <p class="flex_div content_para_1"><span>Gender</span><span>Male</span></p>
                        </div>
                        <div class="flex_div image_modal_div">
                            <button class="show_img_modal"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        </div>
                    </div> --}}

                    <div class="flex_div content_div">
                        <div class="flex_div content_div_1">
                            <div class="flex_div child_head_div">
                                <p class="child_head_count">1</p>
                            </div>
                            <div class="flex_div child_div">
                                <p class="child_para child_para_1">Name</p>
                                <p class="child_para child_para_2">Child Name 1</p>
                            </div>
                            <div class="flex_div child_div">
                                <p class="child_para child_para_1">Date Of Bith </p>
                                <p class="child_para child_para_2">10-02-1999</p>
                            </div>
                            <div class="flex_div child_div">
                                <p class="child_para child_para_1">Gender </p>
                                <p class="child_para child_para_2">Male</p>
                            </div>
                            <div class="flex_div child_file_div">
                                <button>DOB Certificate &nbsp;&nbsp; <i class="fa fa-eye"
                                        aria-hidden="true"></i></button>
                                <button>Disabled Certificate &nbsp;&nbsp; <i class="fa fa-eye"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="flex_div approve_btn_div">
                            <button>Cancel</button>
                            <button>Approved</button>
                            <button>Rejected</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-danger approved_btn">Reject</button>
                    <button type="button" class="btn btn-primary approved_btn">Accept</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="image_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">REVIEW CHILD DETAILS</h5>
                    {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-window-close" aria-hidden="true"></i> --}}
                    {{-- </button> --}}
                    <button id="close_image_modal"><i class="fa fa-window-close" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body ">
                    <div class="flex_div child_img_div">
                        <img src="" id="img_tag" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="no_child" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">REVIEW CHILD DETAILS</h5>
                    {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-window-close" aria-hidden="true"></i> --}}
                    {{-- </button> --}}
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-window-close" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body ">
                    <p id="total_child">You Have No Child</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="no_child_cancel" class="btn btn-secondary zero_child_btn"
                        data-dismiss="modal">Close</button>

                    <button type="button" id="no_child_approve"
                        class="btn btn-primary approved_btn_1 zero_child_btn">Accept</button>
                    <button type="button" id="no_child_reject"
                        class="btn btn-danger approved_btn_1 zero_child_btn">Reject</button>
                </div>
            </div>
        </div>
    </div>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('js/view_employe.js') }}"></script> --}}
    <script src="js/view_employe.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable();
            // $(document).on('change', '#gp_name', function() {

            // })

            // $('#exampleModal').modal('show')
        });
    </script>
    </body>

</html>
