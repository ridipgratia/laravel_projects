class usedMethod {
    constructor() {
    }
    async viewNotification(btn, url) {
        var notify_id = btn.val();
        $.ajax({
            type: "GET",
            url: url,
            data: {
                notify_id: notify_id
            },
            beforeSend: function () {
                $('.notify_loader').eq(0).attr("style", "display:flex !important");
            },
            success: function (result) {
                $('.notify_loader').eq(0).attr("style", "display:none !important");
                if (result.status == 200) {
                    $('.main_full_notify_div').eq(0).attr('style', 'display:flex !important');
                    var block_name = result.message[0].block_name;
                    var file_url = result.message[0].document;
                    $('#block_name').html((block_name) ? block_name : "All Block");
                    $('#notify_link').attr('href', file_url);
                    $('#notify_link').html((file_url) ? 'Document' : 'No Document');
                    $('#notify_sub').html(result.message[0].subject);
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
                $('.notify_loader').eq(0).attr("style", "display:none !important");
            }
        });
    }
}
export default usedMethod;