<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/class.css') }}">
    {{-- <link rel="stylesheet" href="css/class.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/view_list.css') }}">
    {{-- <link rel="stylesheet" href="css/view_list.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    {{-- <link rel="stylesheet" href="css/media.css"> --}}
    <title>Document</title>
</head>

<body>
    <div class="flex_div employe_profile_div">
        <div class="flex_div employe_profile_div_1">
            <p class="employe_profile_para_1">Employe ID</p>
            <p class="employe_profile_para_2">101</p>
        </div>
        <div class="flex_div employe_profile_div_1">
            <p class="employe_profile_para_1">Employe Name</p>
            <p class="employe_profile_para_2">Ridip Name</p>
        </div>
        <div class="flex_div employe_profile_div_1">
            <p class="employe_profile_para_1">Employe Description</p>
            <p class="employe_profile_para_2">Web Developer</p>
        </div>
    </div>
    <div class="flex_div child_have_div">
        <div class="flex_div child_have_div_con">
            <div class="flex_div child_have_div_temp child_have_div_1">
                <div class="flex_div child_have_div_3">
                    <span>* Do you have child ? </span>&nbsp;&nbsp;&nbsp;<span
                        style="font-size: 20px;color:blue;">Yes</span><input type="checkbox" id="child_have_check"
                        style="background-color:red" class="checkbox" onclick="child_have_fun()">&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 20px;color:blue;">No</span><input type="checkbox" id="child_have_check_no"
                        onclick="child_have_no_fun()">&nbsp;&nbsp;&nbsp;
                </div>
                <button type="button" onclick="child_have_fun_1()" id="child_have_btn"
                    class="btn btn-primary child_que_btn">Add
                    Details</button>
                <button type="button" class="btn btn-primary child_que_btn" id="child_have_btn_1">Submit
                </button>
            </div>
            <div class="flex_div child_have_div_temp child_have_div_2">
                {{-- <div class="flex_div child_have_div_3">
                    <span style="font-weight: 500;">* If you don't have any child then click submit .
                </div> --}}
            </div>
            {{-- <div class="flex_div child_have_div_temp child_have_div_2">
                <span style="font-weight: 500;">* If you don't have any child then click submit .
                </span>&nbsp;&nbsp;&nbsp;<button type="button" id="child_have_btn_1" class="btn btn-primary">Submit
                </button>
            </div> --}}
        </div>
    </div>
    <div class="flex_div child_upload_div">
        <p class="no_child">Number Of Child Added :&nbsp;&nbsp;&nbsp;&nbsp;<span id="no_child_span">1</span></p>
        <form action="" method="post" class="flex_div employe_upload_form" id="employe_form"
            enctype="multipart/form-data">
            @csrf
            <table id="employe_table" class="flex_div employe_upload_table">
                <tr class="flex_div employe_upload_table_tr td_row" id="row1">
                    <td class="flex_div child_para_td">
                        <div class="flex_div child_para">
                            <p>Enter Child Details</p>

                        </div>
                    </td>
                    <td class="child_para_1">
                        <p> *Name</p><input type="text" name="child_name[]" class="child_input child_name">
                    </td>
                    <td class="child_para_1">
                        <p> *Gender</p><select name="child_gender[]" class="child_input child_gender">
                            <option value="Male" selected>Male</option>
                            <option value="Female">FeMale</option>
                        </select>
                    </td>
                    <td class="child_para_1">
                        <p> *D.O.B</p><input type="date" name="child_dob[]" class="child_input child_dob">
                    </td>

                    <td class="child_para_1">
                        <p>*DOB Vertificate</p><input type="file" name=" child_file[]"
                            class="child_input  child_file">
                    </td>
                    <td class="child_para_1">
                        <p>
                            Is Child Disabled ?
                        </p>
                        <input type="checkbox" name="check_dis_int" id="check_disbaled" class="count_disabled"
                            value="disabled_div_0">
                    </td>
                    <td class="dis_file child_para_1" id="disabled_div_0">
                        {{-- <p>*Disabled Vertificate</p><input type="file" name=" child_disabled_file[]"
                            class="child_input  child_file"> --}}
                    </td>
                    {{-- <td class="child_para_1">
                        <p> *School Or College</p><input type="text" name="education[]"
                            class="child_input education">
                    </td> --}}
                    <td class="child_para_1"><button type='button' value='DELETE'
                            class='remove_btn remove_btn_1'>Remove</button>
                    </td>
                </tr>
            </table>
            <div class="flex_div add_more_div">
                <button type="button" onclick="add_row()" class="btn btn-primary child_add_more">Add More</button>
            </div>
            <div class="flex_div review_div">
                <div class="flex_div review_div_1">
                    <div class="flex_div review_div_2">
                        <input type="checkbox" class="review_check"
                            id="review_check_id">&nbsp;&nbsp;&nbsp;&nbsp;<span>I
                            do here by confirmed
                            that
                            all the details filled by me are true and currect.</span>
                    </div>
                    <button type="button" class="btn btn-secondary review_btn" data-toggle="modal"
                        onclick="submit_info()" data-target="#exampleModal">Submit</button>
                </div>
            </div>

        </form>
    </div>
    <!-- Button trigger modal -->
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">REVIEW CHILD DETAILS</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-window-close" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="flex_div content_div">
                        <div class="flex_div content_para_div">
                            <p class="flex_div content_para"><span>Child 1</span></p>
                            <p class="flex_div content_para_1"><span>Name</span><span>Ridip
                                    Goswami</span></p>
                            <p class="flex_div content_para_1"><span>D.O.B</span><span>11-02-1999</span></p>
                            <p class="flex_div content_para_1"><span>School/College</span><span>SBMS</span></p>
                            <p class="flex_div content_para_1"><span>Gender</span><span>Male</span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"data-dismiss="modal"
                        id="save_change">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/view_list.js') }}"></script>
    <script>
        function add_row() {
            $rowno = $('#employe_table tr').length;
            $rowno = $rowno + 1;
            $('#no_child_span').html($rowno);
            $('#employe_table tr:last').after("<tr id='row" + $rowno +
                "' class='flex_div td_row employe_upload_table_tr'><td class='flex_div child_para_td'><div class='flex_div child_para'><p>Enter Child Details</p><button type='button' value='" +
                $rowno +
                "' class='child_remove'><i class='fa fa-trash'></i></button></div></td><td class='child_para_1'><p> *Name</p><input type='text' name='child_name[]' class='child_input child_name'></td><td class='child_para_1'><p> *Gender</p><select  name='child_gender[]' class='child_input child_gender'><option value='Male'>Male</option> <option value='Female'>Female</option></select></td><td class='child_para_1'><p> *D.O.B</p><input type='date' name='child_dob[]' class='child_dob child_input' ></td><td class='child_para_1'><p>*DOB Vertificate</p><input type='file' name='child_file[]' class='child_input child_file' ></td><td class='child_para_1' ><p>Is Child Disabled ?</p><input type='checkbox' class='count_disabled' value='disabled_div_" +
                $rowno +
                "' id='check_disbaled'></td> <td class='dis_file child_para_1' id='disabled_div_" + $rowno +
                "'></td> <td class='child_para_1'> <button type='button' value='DELETE' class='remove_btn_1' onclick=delete_row('row" +
                $rowno + "')>Remove</button></td></tr>")
        }

        $(document).ready(function() {
            $('#save_change').on('click', async function(event) {
                event.preventDefault();
                let form_data = new FormData($('#employe_form')[0]);
                $count_disabld = [];
                for (var i = 0; i < $('.count_disabled').length; i++) {
                    if ($('.count_disabled').eq(i).is(":checked")) {
                        $count_disabld.push(1);
                    } else {
                        $count_disabld.push(0);
                    }
                }
                console.log($count_disabld);
                form_data.append('count_disabled_file', $count_disabld);
                $('#save_change').attr('disabled', true);
                await $.ajax({
                    type: "post",
                    url: 'view_list',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        if (result.status == 200) {
                            Swal.fire(
                                'Done',
                                result.message,
                                'success'
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
                        Swal.fire(
                            'Error',
                            'Some Error Executed',
                            'error'
                        );
                    },

                });
                $('#save_change').attr('disabled', false);
            });
            $('#child_have_btn_1').on('click', async function() {
                await Swal.fire({
                    title: 'Are you sure?',
                    text: "Do You Want To Submit",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Submit It!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('add_zero_child') }}",
                            success: function(result) {
                                if (result.status == 200) {
                                    Swal.fire(
                                        'Done',
                                        result.message,
                                        'success'
                                    );
                                }
                            },
                            error: function(data) {
                                Swal.fire(
                                    'Error',
                                    'Some Error Executed',
                                    'error'
                                );
                            }
                        });
                    }
                });

            });
            // $('#review_check_id').on('click', function() {
            //     $.ajax({
            //         type: 'post',
            //         url: "{{ route('review_child') }}",
            //         success: function(result) {
            //             if (result.status == 200) {
            //                 $('.review_div_1').append('<button type"submit" >Submit</button>')
            //             }
            //         }
            //     })
            // })
            $('#review_check_id').change(function() {
                if (this.checked) {
                    $('.review_btn').css('display', 'block');
                } else {
                    $('.review_btn').css('display', 'none');
                }
            });
            $('.review_btn').on('click', function() {})
        });
    </script>
</body>

</html>
