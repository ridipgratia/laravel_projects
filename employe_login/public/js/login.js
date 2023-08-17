function toggle_password() {
    if ($('#password').attr('type') == "password") {
        $('#password').attr('type', 'text');
    } else {
        $('#password').attr('type', 'password');
    }
}
