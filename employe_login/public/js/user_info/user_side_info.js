$(document).ready(function () {
    $('#user_side_select').on('click', function () {
        $('#user_select_image').click();
    });
    $('.user_side_icon').on('click', function () {
        $('.user_side_info').eq(0).css('display', 'flex');
        $('.close_side_info').eq(0).css("display", 'flex');
    });
    $('#close_side_int_btn').on('click', function () {
        $('.user_side_info').eq(0).css('display', 'none');
        $('.close_side_info').eq(0).css("display", 'none');
    })
    $('#user_select_image').on('change', function (e) {
        if (e.target.files.length > 0) {
            var src = URL.createObjectURL(e.target.files[0]);
            $('#user_image').attr('src', src);
        }
    });
    $('#employe_profile_form').on('submit', function (e) {
        e.preventDefault();
        let form_date = new FormData($('#employe_profile_form')[0]);
        $.ajax({
            type: "post",
            url: "/user_info/update_employe_profile",
            data: form_date,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#user_profile_btn').attr("disabled", true);
                $('#user_profile_btn').html("Updating");
            },
            success: function (result) {
                $('#user_profile_btn').attr("disabled", false);
                $('#user_profile_btn').html("Update Profile");
                console.log(result.message);
            },
            error: function (data) {
                $('#user_profile_btn').attr("disabled", false);
                $('#user_profile_btn').html("Update Profile");
            }
        });
    })
});
