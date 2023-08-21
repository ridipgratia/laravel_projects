$(document).ready(function () {
    $('#atten_sign_in').on('click', function () {
        $('#attend_location_modal').modal('show');
    });
    $(document).on('click', '#atten_sing_out', function () {
        Swal.fire(
            'Info',
            'Already Submited !',
            'info'
        )
    })
})
