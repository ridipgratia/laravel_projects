function child_have_fun() {
    var checkbox = document.getElementById('child_have');
    child_count_form = document.getElementsByClassName('child_count_form')[0];
    if (checkbox.checked) {
        child_count_form.style.display = "flex";
    } else {
        child_count_form.style.display = "none";
    }
}
$('#block_name').on('change', function () {
    var block_id = $(this).val();
    $.ajax({
        url: "get_gp_name/" + block_id,
        type: 'GET',
        success: function (result) {
            if ($('#gp_name')) {
                $('#gp_name').remove();
            }
            $('#gp_name_para').append(
                '<select name="gp_name_1" id="gp_name" class="header_title_select"  ><option value="all_gp" selected>Select</option></select>'
            );
            for (var i = 0; i < result.message.length; i++) {
                var gp_id = result.message[i].gp_id;
                var gp_name = result.message[i].gp_name;
                $('#gp_name').append('<option value="' + gp_id + '">' + gp_name +
                    '</option>');
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
});
$('#employe_search').on('click', async function () {
    var gp_code = $('#gp_name').val();
    var block_code = $('#block_name').val();
    await $.ajax({
        type: "GET",
        url: "for_employe_appored",
        data: {
            block_code: block_code,
            gp_code: gp_code
        },
        success: function (result) {
            var dataTable = $('#users-table').DataTable();
            dataTable.clear().draw();
            for (var i = 0; i < result.message.length; i++) {
                dataTable.row.add([result.message[i].id, result.message[i]
                    .name,
                    'Kamrup', result.message[i].block_name, result
                    .message[
                        i].gp_name,
                    '<p class="view_btn"><button class="view_btn_1" value="' + result.message[i].id + '" id="' + result.message[i].id_name + '">View</button><br></p>'

                    // <button class="' + result.message[i].approved.replace(' ', '_') + '"> ' + result.message[i].approved + ' </button>
                ]).draw(false);
            }

        },
        error: function (data) {
            console.log(data);
        }
    });
});
$(document).on('click', '#check_btn', async function () {
    await $.ajax({
        type: 'GET',
        url: 'for_child_approved',
        data: {
            employe_id: $(this).val()
        },
        success: function (result) {
            console.log(result);
            console.log(result.child_count);
            if ($('.content_div').length != 0) {
                $('.content_div').remove();
            }
            $('.modal-body_1').append(
                '<div class="flex_div content_div"></div>')

            for (var i = 0; i < result.message.length; i++) {

                // $('.content_div').append(
                //     '<div class="flex_div content_para_div"><p class="flex_div content_para"><span>Child ' +
                //     (i + 1) +
                //     '</span></p><p class="flex_div content_para_1"><span>Name</span><span>' +
                //     result.message[i].name +
                //     '</span></p><p class="flex_div content_para_1"><span>D.O.B</span><span>' +
                //     result.message[i].dob +
                //     '</span></p><p class="flex_div content_para_1"><span>Gender</span><span>' +
                //     result.message[i].gender +
                //     '</span></p></div><div class="flex_div image_modal_div"><button class="show_img_modal" value="' +
                //     result.message[i].dob_doc +
                //     '"><i class="fa fa-eye "  aria-hidden="true "></i></button><p style="display:none;">' +
                //     result.message[i].emp_id + '</div><hr class="view_hr">'
                // );
                // if (result.message[i].child_approved === 0) {
                //     approved_btn_fun('.approved_btn', 0, 'Rejected');
                // } else if (result.message[i].child_approved === 1) {
                //     approved_btn_fun('.approved_btn', 1, 'Accepted');
                // } else if (result.message[i].child_approved === null) {
                //     $('.approved_btn').css('display', 'block');
                //     $('.approved_btn').eq(1).html('Accept');
                //     $('.approved_btn').eq(0).html('Reject');
                //     $('.approved_btn').eq(1).attr('id', result.message[i]
                //         .accept);
                //     $('.approved_btn').eq(0).attr('id', result.message[i]
                //         .reject);
                //     $('.approved_btn').eq(1).attr('value', result.message[i]
                //         .emp_id);
                //     $('.approved_btn').eq(0).attr('value', result.message[i]
                //         .emp_id);
                // }

                $dob_certificate = result.message[i].dob_doc;
                $disabled_certificate = result.message[i].disabled_file;
                $display = null;
                if ($disabled_certificate == null) {
                    $display = "none";
                }
                $('.content_div').append(
                    '<div class="flex_div content_div_1"><div class="flex_div child_head_div"><p class="child_head_count">' + (i + 1) + '</p></div><div class="flex_div child_div"><p class="child_para child_para_1">Name</p><p class="child_para child_para_2">' + result.message[i].name + '</p></div><div class="flex_div child_div"><p class="child_para child_para_1">Date Of Bith </p><p class="child_para child_para_2">' + result.message[i].dob + '</p></div><div class="flex_div child_div"><p class="child_para child_para_1">Gender </p><p class="child_para child_para_2">' + result.message[i].gender + '</p></div> <div class="flex_div child_file_div"><button value="' + $dob_certificate + '" id="view_dob">DOB Certificate &nbsp;&nbsp; <i class="fa fa-eye"aria-hidden="true"></i></button><button style="display:' + $display + '" value="' + $disabled_certificate + '" id="view_disabed">Disabled Certificate &nbsp;&nbsp; <i class="fa fa-eye"aria-hidden="true"></i></button></div>  </div>'
                )
                if (result.message[i].approval_status === null) {
                    $('.content_div').append('<div class="flex_div approve_btn_div"><button>Cancel</button><button id="accept_id" class="approve" value="' + result.message[i].child_count_id + '">Approve</button><button id="reject_id" class="reject" value="' + result.message[i].child_count_id + '">Reject</button></div>')
                } else if (result.message[i].approval_status === 1) {
                    $('.content_div').append('<div class="flex_div approve_btn_div"><button>Cancel</button><button value="' + result.message[i].child_count_id + '" class="approve">Approved</button></div>')
                } else if (result.message[i].approval_status === 0) {
                    $('.content_div').append('<div class="flex_div approve_btn_div"><button>Cancel</button><button class="reject" value="' + result.message[i].child_count_id + '">Rejected</button></div>')
                }
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
    $('#exampleModal').modal('show');
});

function approved_btn_fun(className, index, text) {
    $(className).css('display', 'none');
    $(className).eq(index).css('display', 'block');
    $(className).eq(index).html(text);
    $(className).eq(index).attr('id', "");
}

function approved_btn_fun_1(className, index, text) {
    $(className).css('display', 'none');
    $(className).eq(index).css('display', 'block');
    $(className).eq(index).html(text);
    $(className).eq(index).attr('id', "");
}


$(document).on('click', '#check_btn_des', async function () {
    await $.ajax({
        type: 'GET',
        url: 'zero-child-approve',
        data: {
            employe_id: $(this).val()
        },
        success: function (result) {
            if (result.status == 400) {
                Swal.fire(
                    'Error',
                    result.message,
                    'error'
                )
            } else {
                $('#no_child').modal('show');
            }
            if (result.index === 0) {
                for (var i = 1; i < 3; i++) {
                    $('.zero_child_btn').eq(i).val(result.message[0].e_id);
                    $('.zero_child_btn').eq(i).css('display', 'block');
                    if (i == 2) {
                        $('.zero_child_btn').eq(i).attr('id', 'no_child_reject');
                    } else if (i == 1) {
                        $('.zero_child_btn').eq(i).attr('id', 'no_child_approve');
                    }
                }
            } else {
                for (var i = 1; i < 3; i++) {
                    if (result.index == i) {
                        $('.zero_child_btn').eq(i).css('display', 'block');
                    } else {
                        $('.zero_child_btn').eq(i).css('display', 'none');
                    }
                    $('.zero_child_btn').eq(i).val(result.message[0].e_id);
                    $('.zero_child_btn').eq(i).attr('id', '');
                }
            }
            // if (result.message[0].child_approved === 0) {
            //     approved_btn_fun_1('.approved_btn_1', 0, 'Rejected');
            // } else if (result.message[0].child_approved === 1) {
            //     approved_btn_fun_1('.approved_btn_1', 1, 'Accepted');
            // } else {
            //     $('.approved_btn_1').css('display', 'block');
            //     $('.approved_btn_1').eq(1).html('Accept');
            //     $('.approved_btn_1').eq(0).html('Reject');
            //     $('.approved_btn_1').eq(1).attr('id', result.message[0]
            //         .accept);
            //     $('.approved_btn_1').eq(0).attr('id', result.message[0]
            //         .reject);
            //     $('.approved_btn_1').eq(1).attr('value', result.message[0]
            //         .emp_id);
            //     $('.approved_btn_1').eq(0).attr('value', result.message[0]
            //         .emp_id);
            // }
        },
        error: function (data) {
            console.log(data);
        }
    });
});
$(document).on('click', '#no_child_approve', async function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Accept ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept It!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            console.log($(this).val())
            const done = await zero_child_post(1, $(this).val());
            $(this).attr('disabled', false);
            $('#no_child').modal('hide')
        }
    });
});
$(document).on('click', '#no_child_reject', async function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Accept ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept It!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            const done = await zero_child_post(0, $(this).val());
            $(this).attr('disabled', false);
            $('#no_child').modal('hide')
        }
    });
})
async function zero_child_post(index, emp_id) {
    await $.ajax({
        type: "get",
        url: "zero-child-approve-post",
        data: {
            emp_id: emp_id,
            approval_index: index
        },
        success: function (result) {
            if (result.status == 400) {
                Swal.fire(
                    'error',
                    result.message,
                    'error'
                )
            } else {
                Swal.fire(
                    'Success',
                    result.message,
                    'success'
                )
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
    return "done";
}
$(document).on('click', '#accept_id', async function () {

    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Accept ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept It!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            const done = await approval_fun(1, $(this).val());
            console.log(done);
            $(this).attr('disabled', false);
            $('#exampleModal').modal('hide')
        }
    })

});
$(document).on('click', '#reject_id', async function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Reject It",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reject it!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            const done = await approval_fun(0, $(this).val());
            console.log(done);
            $(this).attr('disabled', false);
            $('#exampleModal').modal('hide')
        }
    })
});

async function approval_fun(index, child_id) {
    $(this).attr('disabled', true);
    await $.ajax({
        type: 'POST',
        url: '/child_approved',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'JSON',
        data: {
            // emp_id: emp_id,
            child_id: child_id,
            approval_id: index
        },
        success: async function (result) {
            console.log(result);
            $('#employe_search').trigger('click');
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
        error: function (data) {
            console.log(data);
        }
    });
    return 'done';
}
$(document).on('click', '#view_dob', async function () {
    const done = await getFiles($(this).val());
    await $('#image_modal').modal('show');
})
$(document).on('click', '#view_disabed', async function () {
    const done = await getFiles($(this).val());
    await $('#image_modal').modal('show');
})

async function getFiles(file) {
    await $.ajax({
        type: "GET",
        url: "/for_child_img",
        data: {
            url: file
        },
        success: function (result) {
            $('#img_tag').attr('src', result.message);
        },
        error: function (data) {
            console.log(data);
        },
    });
    return "done";
}
$('#close_image_modal').on('click', function () {
    $('#image_modal').modal('hide');
    $('#exampleModal').css('overflow-y', 'auto');
})
