$(document).ready(function () {
    $(document).on('change', '#type_leave', function () {
        if ($(this).val() == "2") {
            $('#medical_file').css('display', 'block');
        } else {
            $('#medical_file').css('display', 'none');
        }
    })
    $('#leave_form_id').on('click', async function () {
        event.preventDefault();
        let form_data = new FormData($('#leave_form')[0]);
        $(this).attr('disabled', true);
        $(this).css('background', 'grey');
        await $.ajax({
            type: "post",
            url: 'leaveFromSubmit',
            data: form_data,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.status == 200) {
                    Swal.fire(
                        'Done',
                        result.message,
                    );
                } else {
                    Swal.fire(
                        'Error',
                        result.message,
                        'error'
                    );
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        $(this).attr('disabled', false);
        $(this).css('background', 'rgb(35, 43, 78)');
    });
})
