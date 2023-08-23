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
                if (result.recent_data.length != 0) {
                    check_logout = null;
                    if (result.check_logout != null) {
                        check_logout = "yes";
                    }
                    setRecentText(result, check_logout);
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
    $('.last_day_text').eq(2).html(result.recent_data[0].login_location_diff + " Meters To Office .");
    $('.last_day_office').eq(1).html(result.recent_data[0].office_name);
    $('.last_day_text').eq(3).html(result.recent_data[0].login_date);
    $('.last_day_text').eq(4).html(result.recent_data[0].logout_time);
    $('.last_day_text').eq(5).html(result.recent_data[0].logout_diff);
}
