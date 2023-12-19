import usedMethod from './usedMethod.js';
const usedmethod = new usedMethod();
$(document).ready(function () {
    console.log("Ok");
    $(document).on('click', '#edit_form_btn', function () {
        console.log("Ok")
        usedmethod.editForm($(this), '/unemp_alowance_form_list/edit_form');
    });
});