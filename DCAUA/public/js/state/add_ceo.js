
$(document).ready(function () {
    $('#add_ceo_form').on('submit', async function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do You Want To Submite It",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                make_ceo();
            }
        });

    })
    async function make_ceo() {
        var form_data = new FormData($('#add_ceo_form')[0]);
        await $.ajax({
            type: "post",
            url: "/add_ceo",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#add_ceo_btn').attr("disabled", true);
            },
            success: function (result) {
                if (result.status == 200) {
                    Swal.fire(
                        'Success',
                        result.message[0] + "<br> User Registration ID -> " + result.message[1] + "<br> User Password -> " + result.message[2],
                        'success'
                    ).then(() => {
                        window.location.href = "/state_dash";
                    })
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
        $('#add_ceo_btn').attr("disabled", false);
    }
})