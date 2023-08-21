$(document).ready(function () {
    $(window).on('load', function () {
        $.ajax({
            type: "GET",
            url: "sectin_data",
            success: function (result) {
                $('.number').eq(0).html(result.message[0].length);
                $('.number').eq(1).html(result.message[1].length);
                $('.number').eq(2).html(result.message[2].length);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
