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
                    '<p class="view_btn"><button class="view_btn_1" value="' + result.message[i].id + '" id="' + result.message[i].id_name + '">View</button><br><button class="' + result.message[i].approved.replace(' ', '_') + '"> ' + result.message[i].approved + ' </button></p > '
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
            if ($('.content_div').length != 0) {
                $('.content_div').remove();
            }
            $('.modal-body_1').append(
                '<div class="flex_div content_div"></div>')

            for (var i = 0; i < result.message.length; i++) {

                $('.content_div').append(
                    '<div class="flex_div content_para_div"><p class="flex_div content_para"><span>Child ' +
                    (i + 1) +
                    '</span></p><p class="flex_div content_para_1"><span>Name</span><span>' +
                    result.message[i].name +
                    '</span></p><p class="flex_div content_para_1"><span>D.O.B</span><span>' +
                    result.message[i].dob +
                    '</span></p> <p class="flex_div content_para_1"><span>School/College</span><span>' +
                    result.message[i].education_status +
                    '</span></p><p class="flex_div content_para_1"><span>Gender</span><span>' +
                    result.message[i].gender +
                    '</span></p></div><div class="flex_div image_modal_div"><button class="show_img_modal" value="' +
                    result.message[i].dob_doc +
                    '"><i class="fa fa-eye "  aria-hidden="true "></i></button><p style="display:none;">' +
                    result.message[i].emp_id + '</div><hr class="view_hr">'
                );
                if (result.message[i].child_approved === 0) {
                    approved_btn_fun('.approved_btn', 0, 'Rejected');
                } else if (result.message[i].child_approved === 1) {
                    approved_btn_fun('.approved_btn', 1, 'Accepted');
                } else if (result.message[i].child_approved === null) {
                    $('.approved_btn').css('display', 'block');
                    $('.approved_btn').eq(1).html('Accept');
                    $('.approved_btn').eq(0).html('Reject');
                    $('.approved_btn').eq(1).attr('id', result.message[i]
                        .accept);
                    $('.approved_btn').eq(0).attr('id', result.message[i]
                        .reject);
                    $('.approved_btn').eq(1).attr('value', result.message[i]
                        .emp_id);
                    $('.approved_btn').eq(0).attr('value', result.message[i]
                        .emp_id);
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
        url: 'for_child_approved',
        data: {
            employe_id: $(this).val()
        },
        success: function (result) {
            if (result.message[0].child_approved === 0) {
                approved_btn_fun_1('.approved_btn_1', 0, 'Rejected');
            } else if (result.message[0].child_approved === 1) {
                approved_btn_fun_1('.approved_btn_1', 1, 'Accepted');
            } else {
                $('.approved_btn_1').css('display', 'block');
                $('.approved_btn_1').eq(1).html('Accept');
                $('.approved_btn_1').eq(0).html('Reject');
                $('.approved_btn_1').eq(1).attr('id', result.message[0]
                    .accept);
                $('.approved_btn_1').eq(0).attr('id', result.message[0]
                    .reject);
                $('.approved_btn_1').eq(1).attr('value', result.message[0]
                    .emp_id);
                $('.approved_btn_1').eq(0).attr('value', result.message[0]
                    .emp_id);
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
    $('#no_child').modal('show');
});
$(document).on('click', '#accept_id', async function () {

    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Accept ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept It!'
    }).then((result) => {
        if (result.isConfirmed) {
            approval_fun(1, $(this).val());
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
    }).then((result) => {
        if (result.isConfirmed) {
            approval_fun(0, $(this).val());
        }
    })
});

function approval_fun(index, emp_id) {
    $.ajax({
        type: 'POST',
        url: '/child_approved',
        dataType: 'JSON',
        data: {
            emp_id: emp_id,
            approval_id: index
        },
        success: function (result) {
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
}
$(document).on('click', '.show_img_modal', async function () {
    await $.ajax({
        type: "GET",
        url: "/for_child_img",
        data: {
            url: $(this).val()
        },
        success: function (result) {
            $('#img_tag').attr('src', result.message);
        },
        error: function (data) {
            console.log(data);
        },

    });
    await $('#image_modal').modal('show');
})
$('#close_image_modal').on('click', function () {
    $('#image_modal').modal('hide');
    $('#exampleModal').css('overflow-y', 'auto');
})
