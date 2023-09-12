$(document).ready(function () {
    $('#change_basic_form').on('submit', function (e) {
        e.preventDefault();
        let form_data = new FormData($('#change_basic_form')[0]);
        $.ajax({
            type: "post",
            url: "/user_info/change_user_basic",
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#user_basic_btn').attr('disabled', true);
                $('#user_basic_btn').html("Trying Save");
            },
            success: function (result) {
                $('#user_basic_btn').attr('disabled', false);
                $('#user_basic_btn').html("Save All");
                $('.error_2').eq(0).css('display', 'block');
                $('.error_2').eq(0).html(result.message);
            },
            error: function (data) {
                $('#user_basic_btn').attr('disabled', false);
                $('#user_basic_btn').html("Save All");
            }
        });
    })
})
