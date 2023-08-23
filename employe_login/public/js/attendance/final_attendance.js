$(document).ready(function () {
    $('#attend_textarea').on('input', function () {
        if ($(this).val().length != 0) {
            $('#submit_location_btn').css('display', 'block');
        } else {
            $('#submit_location_btn').css('display', 'none');
        }
    })
    $('#submit_location_btn').on('click', async function () {
        navigator.geolocation.getCurrentPosition(async (position) => {
            let lat = position.coords.latitude;
            let long = position.coords.longitude;
            console.log($('#attend_textarea').val());
            $(this).attr('disabled', true);
            await $.ajax({
                type: "post",
                url: "/attendance/login",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    location_id: $(this).val(),
                    lat_1: lat,
                    long_1: long,
                    reason: $('#attend_textarea').val()
                },
                success: function (result) {
                    if (result.status == 400) {
                        Swal.fire(
                            'Error',
                            result.message,
                            'error'
                        )
                        // $('#attend_textarea').css('display', 'block');
                    } else {
                        Swal.fire(
                            'Done',
                            result.message,
                            'success'
                        ).then((process) => {
                            location.reload();
                        })
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
            $(this).attr('disabled', false);
        });
    });
});
$(document).on('click', '#final_logout_submit', function () {
    navigator.geolocation.getCurrentPosition(async (position) => {
        let lat = position.coords.latitude;
        let long = position.coords.longitude;
        $(this).attr('disabled', true);
        await $.ajax({
            type: "post",
            url: "/attendance/logout",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                location_id: $(this).val(),
                lat_1: lat,
                long_1: long,
            },
            success: function (result) {
                if (result.status == 400) {
                    Swal.fire(
                        'Error',
                        result.message,
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Done',
                        result.message,
                        'success'
                    ).then((process) => {
                        location.reload();
                    })
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        $(this).attr('disabled', false);
    });
})

function final_cancel_btn() {
    $('#final_logout_model').modal('hide');

}
