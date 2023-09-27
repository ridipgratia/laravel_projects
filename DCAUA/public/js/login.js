$(document).ready(function () {
    $('#login_form').on('submit', function (e) {
        e.preventDefault();
        var form_data = new FormData($('#login_form')[0]);
        $.ajax({
            type: "post",
            url: "/",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.status == 200) {
                    window.location.href = "/state_dash";
                }
                else {
                    Swal.fire(
                        "Error",
                        result.message,
                        "info"
                    )
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    })
})