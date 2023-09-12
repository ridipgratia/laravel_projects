$(document).ready(function () {
    $('#change_pass_form').on('submit', function (e) {
        e.preventDefault();
        let form_data = new FormData($('#change_pass_form')[0]);
        $.ajax({
            type: "post",
            url: "/user_info/change_password",
            // headers: {
            //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            // },
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#change_pass_btn').attr('disabled', true);
                $('#change_pass_btn').html('Sending Email');
            },
            success: function (result) {
                $('.error_1').eq(0).html(result.message);
                $('.error_1').eq(0).css('display', 'block');
                $('#change_pass_btn').html('Change Password');
                $('#change_pass_btn').attr('disabled', false);
            },
            error: function (data) {
                console.log(data);
                $('#change_pass_btn').html('Change Password');
                $('#change_pass_btn').attr('disabled', false);
            }
        });
    })
})
