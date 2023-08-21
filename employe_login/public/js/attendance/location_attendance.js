$(document).ready(function () {
    $(document).on('click', '#locations_submit_btn', function () {
        console.log("Ok");
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
                })
            }
        })
    })
})
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
}
