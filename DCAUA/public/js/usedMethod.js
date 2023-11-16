class usedMethod {
    constructor() {

    }
    async viewNotification(btn) {
        var notify_id = btn.val();
        $.ajax({
            type: "GET",
            url: "/district/view_full_notification",
            data: {
                notify_id: notify_id
            },
            success: function (result) {
                if (result.status == 200) {
                    console.log(result.message);
                    $('.main_full_notify_div').eq(0).attr('style', 'display:flex !important');
                    var block_name = result.message[0].block_name;
                    var file_url = result.message[0].document;
                    $('#block_name').html((block_name) ? block_name : "All Block");
                    $('#notify_link').attr('href', file_url);
                    $('#notify_link').html((file_url) ? 'Document' : 'No Document');
                    $('#notify_des').html(result.message[0].description);
                } else {
                    Swal.fire(
                        'Information',
                        result.message,
                        'info'
                    );
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}
export default usedMethod;