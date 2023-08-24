function menu_btn_fun() {
    // if ($('.side_nav_link').eq(0).is(':visible')) {
    //     $('.side_nav_link').eq(0).css('display', 'none');
    //     $('.user_text').css('display', 'none');
    // } else {
    //     $('.side_nav_link').eq(0).css('display', 'flex');
    //     $('.user_text').css('display', 'block')
    // }
    $('.main_side_nav_div').eq(0).css('display', 'flex');
    $('.top_side_nav').eq(0).css('display', 'none');
    $('.nav_close').eq(0).css('display', 'flex');
}

function menu_side_close() {
    $('.main_side_nav_div').eq(0).css('display', 'none');
    $('.top_side_nav').eq(0).css('display', 'flex');
    $('.nav_close').eq(0).css('display', 'none');
}
