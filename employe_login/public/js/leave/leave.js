$(document).ready(function () {
    $('#leave_his_select').on('change', function () {
        $.ajax({
            type: "get",
            url: "leave-history",
            data: {
                select_month: $(this).val()
            },
            datatype: 'html',
            beforeSend: function () {
                if ($('.leave_his_data_div_2')) {
                    $('.leave_his_data_div_2').remove();
                }
                $('.leave_his_data_div').append('<div class="flex_div leave_his_data_div_2"></div>');
            }
        }).done(function (result) {
            if (result[0] == 200) {
                for (var i = 0; i < result[1].length; i++) {
                    $('.leave_his_data_div_2').append(result[1][i]);
                }
            } else {
                $('.leave_his_data_div_2').append('<p>No Data Found </p>');
            }
        });
    });
    $('#leave_his_date').on('change', function () {
        $.ajax({
            type: "get",
            url: "leave-history-date",
            data: {
                leave_his_date: $(this).val()
            },
            datatype: "html",
            beforeSend: function () {
                if ($('.leave_his_data_div_2')) {
                    $('.leave_his_data_div_2').remove();
                }
                $('.leave_his_data_div').append('<div class="flex_div leave_his_data_div_2"></div>');
            }
        }).done(function (result) {
            if (result[0] == 200) {
                for (var i = 0; i < result[1].length; i++) {
                    $('.leave_his_data_div_2').append(result[1][i]);
                }
            } else {
                $('.leave_his_data_div_2').append('<p>No Data Found</p>');
            }
        });
    });
    $(document).on('click', '#leave_action_view', function () {

        $.ajax({
            type: "get",
            url: "review-leave-application",
            data: {
                leave_application_id: $(this).val()
            },
            datatype: "html",
            beforeSend: function () {
                if ($('.review_leave_div')) {
                    $('.review_leave_div').remove();
                }
                $('.main_review_leve_div').append('<div class="flex_div review_leave_div"></div>')
            }
        }).done(function (result) {
            if (result[0] == 200) {
                $('.review_leave_div').append(result[1]);
                $('#review_leave').modal('show');
            } else {
                Swal.fire(
                    'Info',
                    'No data Found ',
                    'info'
                )
            }
        });
    });
    $(document).on('click', '#leave_action_remove', async function () {
        $application_id = $(this).val();
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
                removeLeave($application_id);
            }
        })
    })
    $(document).on('click', '#view_medical', async function () {
        await $.ajax({
            type: "get",
            url: "leave-medical-file",
            data: {
                medical_url: $(this).val()
            },
            success: function (result) {
                $('#leave_medical_tag').attr('src', result.message);
                $('#leave_medical').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    })


});
async function removeLeave(application_id) {
    await $.ajax({
        type: "get",
        url: "remove-leave-application",
        data: {
            leave_application_id: application_id
        },
        success: async function (result) {
            console.log(result.message);
            if (result.status == 200) {
                Swal.fire(
                    'Info',
                    "Leave Application Removed !",
                    'info'
                )
                location.reload();
            } else {
                Swal.fire(
                    'Info',
                    'Data Not Found !',
                    'info'
                )
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function leave_medical_close() {
    console.log("Ok");
    $('#leave_medical').modal('hide');
    $('#review_leave').modal('show');
    $('#review_leave').css('overflow-y', 'auto');
}
