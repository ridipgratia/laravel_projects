$(document).ready(function () {
    $(document).on('click', '#submit_sign_in', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do You Want To Approve It",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    let lat = position.coords.latitude;
                    let long = position.coords.longitude;
                    await $.ajax({
                        type: "post",
                        url: "/attendance/locations",
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            location_id: $(this).val(),
                            lat_1: lat,
                            long_1: long
                        },
                        success: async function (result) {
                            if (result.status == 400) {
                                Swal.fire(
                                    'Error',
                                    result.message,
                                    'info'
                                ).then((process) => {
                                    location.reload();
                                })
                            } else {
                                console.log(result.message);
                                await setText(result);
                                $('#attend_location_modal').modal('hide');
                                $('#final_attend_submit_modal').modal('show');
                                $('#final_attend_submit_modal').css('overflow-y', 'auto');
                            }

                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                });
            }
        });
    });
});
$(document).on('click', '#submit_sign_out', function () {
    $location_id = $(this).val();
    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Approve It",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approve it!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                let lat = position.coords.latitude;
                let long = position.coords.longitude;
                console.log(lat);
                console.log(long);
                await $.ajax({
                    type: "post",
                    url: "/attendance/locations/logout",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        location_id: $(this).val(),
                        lat_1: lat,
                        long_1: long
                    },
                    success: async function (result) {
                        if (result.status == 400) {
                            Swal.fire(
                                "Error",
                                result.message,
                                'info'
                            )
                        } else {
                            console.log(result.message);
                            await setLogoutText(result);
                            $('#attend_location_modal').modal('hide');
                            $('#final_logout_model').modal('show');
                            $('#final_logout_model').css('overflow-y', 'auto');
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        } else {
            console.log($location_id);
        }
    });
});
async function setText(result) {
    $('#office_name').html(result.message[3]);
    $('#main_time').html(result.message[0][1]);
    $('#day').html(result.message[1][1]);
    $('#year').html(result.message[1][0]);
    $('#meter').html(result.message[0][0].toFixed(3));
    $('#time').html(result.message[2]);
    $('#submit_location_btn').val(result.location_id);
    $('#attend_textarea').val('');
    $('#attend_textarea').css('display', result.reason);
    if (result.reason === 'block') {
        $('#submit_location_btn').css('display', 'none');
    } else {
        $('#submit_location_btn').css('display', 'block');
    }
}
async function setLogoutText(result) {
    $('#Logout_office_name').html(result.message[2]);
    $('#Logout_main_time').html(result.message[0][1]);
    $('#Logout_day').html(result.message[1][1]);
    console.log(result.message[1][0]);
    $('#Logout_year').html(result.message[1][0]);
    $('#Logout_meter').html(result.message[0][0].toFixed(3));
    $('#final_logout_submit').val(result.location_id);
}
