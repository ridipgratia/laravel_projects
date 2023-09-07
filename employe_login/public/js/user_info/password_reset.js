$(document).ready(function () {
    $('#password_drop_down').on('click', function () {
        if ($('.reset_password_emails_div').eq(0).is(':visible')) {
            $('.reset_password_emails_div').eq(0).css('display', 'none');
        } else {
            $('.reset_password_emails_div').eq(0).css('display', 'flex');
        }
    });
});
