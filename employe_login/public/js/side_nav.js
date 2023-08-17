function menu_btn_fun() {
    if ($('.side_nav_link').eq(0).is(':visible')) {
        $('.side_nav_link').eq(0).css('display', 'none');
        $('.user_text').css('display', 'none');
    } else {
        $('.side_nav_link').eq(0).css('display', 'flex');
        $('.user_text').css('display', 'block')
    }
}
