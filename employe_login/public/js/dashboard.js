$(document).ready(function () {
    $('.side_nav_p').eq(0).addClass('selected');
    $('#basic_btn').on('click', function () {
        side_nav_fun(0);
        detail_show_fun(0);
        $('.details_head').html("Basic Details");
    })
    $('#education_btn').on('click', async function () {
        $emp_code = $('.side_nav_p').eq(1).val();
        await $.ajax({
            type: "get",
            url: "/dashboard/education",
            data: {
                emp_code: $emp_code
            },
            success: function (result) {
                if (('.education_div_1').length != 0) {
                    $('.education_div_1').remove();
                }
                for (var i = 0; i < result.message.length; i++) {
                    $('#education_div').append(
                        "<div class='flex_div education_div_1 detaling_div'> <div class='flex_div education_div_3 detaling_div_1'> <p class='flex_div details_p'><span>Board Name :</span><span>" + result.message[i].board + "</span></p><p class='flex_div details_p'><span>School/College :</span><span>" + result.message[i].school_college + "</span></p><p class='flex_div details_p'><span>Degree :</span><span>" + result.message[i].degree + "</span></p><p class='flex_div details_p'><span>Passing Year :</span><span>" + result.message[i].year + "</span></p><p class='flex_div details_p'><span>Percentage :</span><span>" + result.message[i].percentage + "</span></p><p class='flex_div details_p'><span>Marks :</span><span>" + result.message[i].marks + "</span></p><div class='flex_div file_div'><button value=" + result.message[i].education_certificate + " class='file_btn' id='education_file'>View</button> </div> </div>"
                    )
                }

            },
            error: function (data) {
                console.log(data);
            }
        });
        side_nav_fun(1);
        detail_show_fun(1);
        $('.details_head').html("Educatinal Details");
    })
    $('#expirience_btn').on('click', async function () {
        $emp_code = $('.side_nav_p').eq(2).val();
        await $.ajax({
            type: "get",
            url: "/dashboard/expirience",
            data: {
                emp_code: $emp_code
            },
            success: function (result) {
                if (('.expirience_div_1').length != 0) {
                    $('.expirience_div_1').remove();
                }
                for (var i = 0; i < result.message.length; i++) {
                    $('#expirience_div').append(
                        "<div class='flex_div expirience_div_1 detaling_div'> <div class='flex_div expirience_div_3 detaling_div_1'> <p class='flex_div details_p'><span>Compnay Name :</span><span>" + result.message[i].company_name + "</span></p><p class='flex_div details_p'><span>Expirinece Year :</span><span>" + result.message[i].ex_year + "</span></p><p class='flex_div details_p'><span>Employe Role :</span><span>" + result.message[i].emp_role + "</span></p><p class='flex_div details_p'><span>To Date :</span><span>" + result.message[i].to_date + "</span></p><p class='flex_div details_p'><span>Form Date :</span><span>" + result.message[i].form_date + "</span></p><div class='flex_div file_div'><button value=" + result.message[i].ex_certificate + " class='file_btn' id='expirience_file'>View</button> </div> </div>"
                    )
                }

            },
            error: function (data) {
                console.log(data);
            }
        });
        side_nav_fun(2);
        detail_show_fun(2);
        $('.details_head').html("Expirience Details");
    })
    $('#leave_btn').on('click', async function () {

        $emp_code = $('.side_nav_p').eq(3).val();
        $('.details_head').html("Leave Stock Information");
        await $.ajax({
            type: "get",
            url: "dashboard/leave",
            data: {
                emp_code: $emp_code
            },
            success: function (result) {
                if ($('.leave_div_1').length != 0) {
                    $('.leave_div_1').remove();
                }
                for (var i = 0; i < result.message.length; i++) {
                    $('#leave_div').append('<div class="flex_div leave_div_1 detaling_div"><div class="flex_div leave_div_3 detaling_div_1"><h1>' + result.message[i].leave_name + '</h1><p class="flex_div leave_head_p"><span>Leave Year</span><span>Leave Allocation</span><span>Leave Balance</span></p><p class="flex_div leave_head_p"><span>' + result.message[i].year + '</span><span>' + result.message[i].leave_allocation + '</span><span>' + result.message[i].leave_balance + '</span>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        side_nav_fun(3);
        detail_show_fun(3);
    })
    $(document).on('click', '#education_file', async function () {
        $image_url = $(this).val();
        var getImageUrl = await getUrl($image_url, '/dashboard/edu_file')
        if (getImageUrl[1] == 200) {
            $('#img_tag').attr('src', getImageUrl[0]);
            $('#image_modal').modal('show');
        } else {
            Swal.fire(
                'Error',
                'Invalid Image Url',
                'Ok'
            );
        }
    })
    $(document).on('click', '#expirience_file', async function () {
        $image_url = $(this).val();
        var getImageUrl = await getUrl($image_url, '/dashboard/ex_file');
        if (getImageUrl[1] == 200) {
            $('#img_tag').attr('src', getImageUrl[0]);
            $('#image_modal').modal('show');
        } else {
            Swal.fire(
                'Error',
                'Invalid Image Url',
                'Ok'
            );
        }

    })
    $
})

async function getUrl(imageUrl, routeUrl) {
    var final_image_url;
    var status;
    await $.ajax({
        type: "get",
        url: routeUrl,
        data: {
            imageUrl: imageUrl
        },
        success: function (result) {
            final_image_url = result.imageURL;
            status = result.status;
        },
        error: function (data) {
            console.log(data);
        }
    });
    return [final_image_url, status];
}

function side_nav_fun($show_index) {
    $len = $('.side_nav_p').length;
    for (var i = 0; i < $len; i++) {
        if ($show_index == i) {
            // $('.side_nav_p').eq($show_index).css('background', '#77d5fd');
            $('.side_nav_p').eq(i).addClass('selected');
        } else {
            // $('.side_nav_p').eq(i).css('background', '#2382ab');
            $('.side_nav_p').eq(i).removeClass('selected');
        }
    }
}

function detail_show_fun($show_index) {
    $len = $('.detalis_div').length;
    for (var i = 0; i < $len; i++) {
        if ($show_index == i) {
            $('.detalis_div').eq($show_index).css('display', 'flex');
        } else {
            $('.detalis_div').eq(i).css('display', 'none');
        }
    }
}

function menu_btn_fun() {
    if ($('.side_nav_div').eq(0).is(':visible')) {
        $('.side_nav_div').css('display', 'none');
    } else {
        $('.side_nav_div').css('display', 'flex');
    }

}
