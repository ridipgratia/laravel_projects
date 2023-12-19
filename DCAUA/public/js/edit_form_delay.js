import usedMethod from './usedMethod.js';
const usedmethod = new usedMethod();
$(document).ready(function () {
    $(document).on('click', '#edit_form_btn', function () {
        usedmethod.editForm($(this), '/delay_compensation_form_list/edit_form');
    });
});
