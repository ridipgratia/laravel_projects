import usedMethod from './usedMethod.js';
const usedmethod = new usedMethod();
$(document).ready(function () {
    console.log("Ok");
    $(document).on('click', '#edit_form_btn', function () {
        console.log("Ok")
        usedmethod.editForm($(this), '/unemp_alowance_form_list/edit_form');
    });
    $(document).on('click', '#update_edit_form', async function (e) {
        e.preventDefault();
        usedmethod.submitEditForm($('#submit_edit_form'), '/unemp_alowance_form_list/update_edit_form', $(this));
    });
});