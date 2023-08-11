$(document).ready(function () {
    $(document).on('click', '#leave_btn', async function () {
        $.ajax({
            type: "GET",
            url: "admin_leave_submit",
            data: {
                id: $(this).val(),
            },
            success: function (result) {
                $('.review_text').eq(0).html(result.message[0].employe_name);
                $('.review_text').eq(1).html(result.message[0].leave_name);
                $('.review_text').eq(2).html(result.message[0].day_name);
                $('.review_text').eq(3).html(result.message[0].form_date);
                $('.review_text').eq(4).html(result.message[0].to_date);
                // $('.review_text').eq(5).html(result.un_paid + '/' + result.extra_day);
                $('.review_span').eq(2).html(result.un_paid);
                $('.review_span').eq(3).html(result.extra_day);
                $('.review_text').eq(6).html(result.message[0].reason);
                $('.review_text').eq(7).html(result.message[0].no_day);
                $('.review_text').eq(8).val(result.message[0].medical);
                $('#approve_id').val(result.message[0].id);
                $('#reject_id').val(result.message[0].id);
            },
            error: function (data) {
                console.log(data);
            }
        });
        $('#exampleModal').modal('show');
    });
    $(document).on('click', '#review_btn', async function () {
        if ($(this).val() == "") {
            Swal.fire(
                'Information',
                'Medical Document Not Necessary !',
                'info'
            )
        } else {
            await $.ajax({
                type: "GET",
                url: "admin_leave_image",
                data: {
                    url: $(this).val()
                },
                success: function (result) {
                    $('#img_tag').attr('src', result.message);
                },
                error: function (data) {
                    console.log(data);
                }
            });
            $('#image_modal').modal('show');
        }
    });
    $(document).on('click', '#close_image_modal', function () {
        $('#image_modal').modal('hide');
        $('#exampleModal').css('overflow-y', 'auto');
    });
    $(document).on('click', '#approve_id', async function () {
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
                $(this).attr('disabled', true);
                $(this).css('background', 'grey');
                approval_fun(1, $(this).val());
            }
        })
    });
    $(document).on('click', '#reject_id', async function () {
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
                $(this).attr('disabled', true);
                $(this).css('background', 'grey');
                approval_fun(0, $(this).val());
            }
        })
    });
    async function approval_fun(index, emp_id) {

        await $.ajax({
            type: "POST",
            url: "admin_leave_approval",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: emp_id,
                approval_id: index
            },
            success: async function (result) {
                if (result.status == 200) {
                    console.log(result.message);
                    await Swal.fire(
                        'Done',
                        result.message,
                        'success'
                    );
                    location.reload(true);
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
})
