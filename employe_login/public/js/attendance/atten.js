$(document).ready(function () {
    $('#sign_in').on('click', async function () {
        navigator.geolocation.getCurrentPosition(async (position) => {
            let lat = position.coords.latitude;
            let long = position.coords.longitude;
            console.log(lat);
            console.log(long);
            var btn_id;
            await $.ajax({
                type: "post",
                url: "/attendance/login",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    lat_1: lat,
                    long_1: long
                },
                success: function (result) {
                    if (result.status == 400) {
                        console.log(result.message[1]);
                    } else {
                        console.log(result.message[1]);
                        console.log(result.data);
                        btn_id = result.message[0];
                    }

                },
                error: function (data) {
                    console.log(data);
                }
            });
            $('#sign_in').remove();
            $('#div').append('<button id="' + btn_id + '">' + btn_id.replace('_', ' ') + '</button>');
        });
    });
    $(document).on('click', '#reason_submit', function () {

        $.ajax({
            type: "get",
            url: "/attendance/login_submit",

            data: {
                submit: true
            },
            success: function (result) {
                console.log(result.message);
            },
            error: function (data) {
                console.log(data);
            }
        });
    })
    $(document).on('click', '#location_btn', function () {
        navigator.geolocation.getCurrentPosition(async (position) => {
            let lat = position.coords.latitude;
            let long = position.coords.longitude;
            await $.ajax({
                type: "post",
                url: "/attendance/login/login",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    lat_1: lat,
                    long_1: long
                },
                success: function (result) {
                    if (result.status == 400) {
                        console.log(result.message);
                    } else {
                        $('#text').css('display', result.display);
                        console.log(result.display);
                        console.log(result.time);
                    }

                },
                error: function (data) {
                    console.log(data);
                }
            });
        })
    })
})
