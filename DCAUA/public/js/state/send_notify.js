import StateClass from "./StateClass.js";
$(document).ready(function () {

    const stateclass = new StateClass();
    $('#view_notification_btn').on('click', function () {

        $('.main_view_notify_div').eq(0).attr("style", "display:flex !important");
        $('.main_send_notification_div').eq(0).attr("style", "display:none !important");
    });
    $('#notification_btn').on('click', function () {
        $('.main_view_notify_div').eq(0).attr("style", "display:none !important");
        $('.main_send_notification_div').eq(0).attr("style", "display:flex !important");
    });
    $(document).on('change', '#send_notify_select_1', function () {
        var district_code = $(this).val();
        console.log(district_code);
        stateclass.getBlockByDistrict('/delay_compensation/get_blocks', district_code, '#send_notify_select_2');
    });
    $('#send_notify_file_btn').on('click', function () {
        $('#send_notify_file').click();
    });
    $('#send_notify_form').on('submit', function (event) {
        var form_data = new FormData($('#send_notify_form')[0]);
        event.preventDefault();
        $.ajax({
            type: "post",
            url: "/send_notify_form",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data: form_data,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.status == 200) {
                    console.log(result.message);
                } else {
                    Swal.fire(
                        'Information',
                        result.message,
                        'info'
                    );
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    })
});