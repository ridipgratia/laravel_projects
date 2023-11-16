import usedMethod from '../usedMethod.js';
$(document).ready(function () {
    const usedmethod = new usedMethod();
    $(document).on('click', '.recive_notify_btn', function () {
        usedmethod.viewNotification($(this));
    });
    $('.full_notify_close').on('click', function () {
        $('.main_full_notify_div').eq(0).attr('style', 'display:none !important');
    })
});
