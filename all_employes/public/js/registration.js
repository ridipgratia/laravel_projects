$(document).ready(function () {
    $('.step_div_1').eq(0).css({
        "background": "#2184be",
        "color": "white"
    });
    $('.spin').eq(0).css({
        "display": "block"
    });
    $(document).on('click', '#form_btn_1', async function (event) {
        event.preventDefault();
        $index_num = $(this).val();
        console.log($index_num);
        if ($index_num == 3) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do You Want To Approve It",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $(this).attr('disabled', true);
                    // $(this).css('background', 'grey');
                    send_data($index_num);
                }
            })
        } else {
            send_data($index_num);
        }
    });

    async function send_data($index_num) {
        let form_data = new FormData($('#registration_form_id')[0]);
        form_data.append('index_num', $index_num);
        await $.ajax({
            type: "post",
            url: "registration",
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (result) {
                console.log(result.all_error);
                if (result.status == 200) {
                    if ($index_num == 1) {
                        icon_hide_fun()
                        icon_show_fun('.tested', 0);
                        icon_show_fun('.spin', 1);
                        $('#reg_1').css('display', 'none');
                        $('#reg_2').css('display', 'flex');
                        step_form(1);
                    } else if ($index_num == 2) {
                        icon_hide_fun()
                        icon_show_fun('.tested', 0);
                        icon_show_fun('.tested', 1);
                        icon_show_fun('.spin', 2);
                        $('#reg_2').css('display', 'none');
                        $('#reg_3').css('display', 'flex');
                        step_form(2);
                    } else if ($index_num == 3) {
                        icon_hide_fun()
                        icon_show_fun('.tested', 0);
                        icon_show_fun('.tested', 1);
                        icon_show_fun('.tested', 2);
                        Swal.fire(
                            "Sucessfull",
                            result.message,
                            'success'
                        )
                    }
                } else {
                    $('.spin').eq($index_num - 1).css('display', "none");
                    $('.tested').eq($index_num - 1).css('display', "none");
                    icon_show_fun('.wrong', $index_num - 1);
                    $('.error_div').remove();
                    $('.modal-body').append('<div class="error_div"></div>');
                    var errors = result.all_error;
                    var i = 0;
                    Object.keys(errors).forEach(key => {
                        i++;
                        $('.error_div').append('<p>' + (i) + '. ' + errors[key] + '</p>');
                    })
                    $('#error_modal').modal('show');
                }

            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    // $(document).on('click', '#form_btn_2', function () {
    //     $('#reg_2').css('display', 'none');
    //     $('#reg_3').css('display', 'flex');
    //     step_form(2);
    // });
    // $(document).on('click', '#form_btn_3', function () {
    //     alert("Last Page")
    // });
    $(document).on('click', '#add_education', function () {
        $len = $('.education_tab').length;
        $len = $len + 1;
        $('.education_tab:last').after('<tr class="flex_div registration_tr_1 education_tab" id="edu_row' + $len + '"><td class="flex_div registration_td_1" style="width:97%;"> <span class="count_education">' + $len + '</span> <span onclick=delete_edu_row("edu_row' + $len + '")> <i class = "fa fa-trash"></i></span> </td><td class="flex_div registration_td"><p>Board Name</p><input type="text" name="emp_board_name[]"></td></td><td class="flex_div registration_td"><p>Degree Name</p><input type="text" name="emp_degree[]"></td> <td class="flex_div registration_td"><p>School Or College</p><input type="text" name="emp_school[]"></td><td class="flex_div registration_td"><p>Passing Year</p><input type="number" name="emp_passing_year[]"></td><td class="flex_div registration_td"><p>Perentage</p><input type="number" name="emp_percentage[]"></td><td class="flex_div registration_td"><p>Marks</p><input type="number" name="emp_marks[]"></td><td class="flex_div registration_td"><p>Certificate</p><input type="file" name="emp_education_file[]" style="border:none;"></td></tr> ');
    });
    $(document).on('click', '#add_company', function () {
        $len = $('.company_tab').length;
        $len = $len + 1;
        $('.company_tab:last').after('<tr class="flex_div registration_tr_1 company_tab" id="com_row' + $len + '"><td class="flex_div registration_td_1" style="width:97%;"> <span class="count_company">' + $len + '</span> <span onclick=delete_com_row("com_row' + $len + '")> <i class = "fa fa-trash"></i></span> </td><td class="flex_div registration_td"><p>Company Name</p><input type="text" name="emp_com_name[]"></td></td><td class="flex_div registration_td"><p>Form Date</p><input type="date" name="emp_form_date[]"></td><td class="flex_div registration_td"><p>To Date</p><input type="date" name="emp_to_date[]"></td><td class="flex_div registration_td"><p>Job Role</p><input type="text" name="emp_role[]"></td><td class="flex_div registration_td"><p>Expirience Certificate</p><input type="file" name="emp_ex_certificate[]" style="border:none;"></td></tr>');
    });
})

function icon_show_fun(icon_1, index) {

    $(icon_1).eq(index).css("display", "block");
}

function icon_hide_fun() {
    $('.tested').css("display", "none");
    $('.wrong').css("display", "none");
    $('.spin').css("display", "none");
}

function delete_edu_row($id) {
    $('#' + $id).remove();
    $row_len = $('.education_tab').length;
    for (var i = 0; i < $row_len; i++) {
        $('.count_education').eq(i).html(i + 1);
    }
}

function delete_com_row($id) {
    $('#' + $id).remove();
    $row_len = $('.company_tab').length;
    for (var i = 0; i < $row_len; i++) {
        $('.count_company').eq(i).html(i + 1);
    }
}

function prev_fun(id_1, id_2, index) {
    $(id_1).css('display', 'flex');
    $(id_2).css('display', 'none');
    step_form(index);
}

function step_form(index) {
    for (var i = 0; i < 3; i++) {
        if (i == index) {
            $('.step_div_1').eq(i).css({
                "background": "#2184be",
                "color": "white"
            });
        } else {
            $('.step_div_1').eq(i).css({
                "background": "#eee",
                "color": "#aaa"
            });
        }
    }
}
