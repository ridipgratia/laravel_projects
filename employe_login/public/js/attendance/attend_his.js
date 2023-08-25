$(document).ready(function () {
    $('#attend_his_export_btn').on('click', function () {
        $.ajax({
            type: "get",
            data: {
                his_from: $('#his_from').val(),
                his_to: $('#his_to').val()
            },
            url: "attendance/attend_his",
            success: function (result) {
                if (result.status == 400) {
                    Swal.fire(
                        'Info',
                        result.message,
                        'info'
                    )
                } else {
                    if ($('.main_attend_his_data_div')) {
                        console.log("Yes");
                        $('.main_attend_his_data_div').remove();
                    }
                    $('.attend_his_data_div').append('<div class="flex_div main_attend_his_data_div"></div>');
                    for (var i = 0; i < result.message.length; i++) {
                        if (result.message[i][0].logout_time == null) {
                            result.message[i][0].logout_time = "No Record"
                            result.message[i][0].logout_diff = "No Record"
                            result.message[i][0].logout_location = "No Record"
                        }
                        setHistory(result, i);
                    }
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
})

function setHistory(result, index) {
    $('.main_attend_his_data_div').append(
        '<div class="flex_div attend_his_data_div_1"><div class="flex_div attend_his_data_div_2"><div class="flex_div attend_his_data_div_3 attend_color_1"> <p class="attend_his_data_count">' + (index + 1) + '</p> <p class="attend_his_data_head">Login</p></div> <div class="flex_div attend_his_data_4"> <p class="flex_div attend_his_data_label attend_his_data_label_text"><span><i class="fa fa-calendar-day"></i> Date</span><span><i class="fa fa-clock"></i> Signin Time</span><span><i class="fa fa-location-arrow"></i> Signin Distance</span></p><p class="flex_div attend_his_data_label_data attend_his_data_label_text"><span>' + result.message[index][0].login_date + '</span><span>' + result.message[index][0].login_time +
        '</span><span>' + result.message[index][0].login_location_diff.toFixed(2) + ' Meter</span></p><p class="attend_his_data_office"> <span><i class="fa fa-building"></i> ' + result.message[index][0].office_name + '</span></p></div></div><div class="flex_div attend_his_data_div_2"><div class="flex_div attend_his_data_div_3 attend_color_2"><p class="attend_his_data_count">1</p><p class="attend_his_data_head">Logout</p></div><div class="flex_div attend_his_data_4"><p class="flex_div attend_his_data_label attend_his_data_label_text"><span><i class="fa fa-calendar-day"></i> Date</span><span><i class="fa fa-clock"></i> Signout Time</span><span><i class="fa fa-location-arrow"></i> Signout Distance</span></p><p class="flex_div attend_his_data_label_data attend_his_data_label_text"><span>10-08-2023</span><span>6:00</span><span>9.20 Meter</span></p><p class="attend_his_data_office"><span><i class="fa fa-building"></i> GRATIA</span></p></div></div>'
    )
}
