window.onload = function () {
    var today = new Date().toISOString().split('T')[0];
    console.log(today);
    document.getElementById("recent_date").setAttribute('max', today);
}
$(document).ready(function () {
    $(document).on('change', '#recent_date', async function () {
        $('.load_recent_div').css('display', 'flex');
        await $.ajax({
            type: "get",
            url: "/attendance/recent_date",
            data: {
                recent_date: $(this).val()
            },
            success: function (result) {
                if (result.status == 400) {
                    Swal.fire(
                        'Information',
                        result.message,
                        'info'
                    )
                } else {
                    if (result.recent_data.length != 0) {
                        check_logout = null;
                        if (result.recent_data[0].logout_time != null) {
                            check_logout = "yes";
                        }
                        setRecentText(result, check_logout);
                    }
                }

            },
            error: function (data) {
                console.log(data);
            }
        });
        $('.load_recent_div').css('display', 'none');
    })

})
async function setRecentText(result, check_logout) {
    $('.last_day_office').eq(0).html(result.recent_data[0].office_name);
    $('.last_day_text').eq(0).html(result.recent_data[0].login_date);
    $('.last_day_text').eq(1).html(result.recent_data[0].login_time);
    $('.last_day_text').eq(2).html(result.recent_data[0].login_location_diff.toFixed(2) + " Meters To Office .");
    if (check_logout == "yes") {
        $('.last_day_office').eq(1).html(result.recent_data[0].logout_location);
        $('.last_day_text').eq(3).html(result.recent_data[0].login_date);
        $('.last_day_text').eq(4).html(result.recent_data[0].logout_time);
        $('.last_day_text').eq(5).html(result.recent_data[0].logout_diff.toFixed(2) + " Meters To Office .");
        $('.recent_logout_div').eq(0).css('display', 'flex');
    } else {
        $('.last_day_office').eq(1).html('Waiting');
        $('.last_day_text').eq(3).html('Waiting');
        $('.last_day_text').eq(4).html('Waiting');
        $('.last_day_text').eq(5).html('Waiting');
        $('.recent_logout_div').eq(0).css('display', 'none');
    }


}
