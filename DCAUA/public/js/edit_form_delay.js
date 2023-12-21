import usedMethod from './usedMethod.js';
const usedmethod = new usedMethod();
$(document).ready(function () {
    $(document).on('click', '#edit_form_btn', function () {
        usedmethod.editForm($(this), '/delay_compensation_form_list/edit_form');
    });
    $(document).on('click', '#update_edit_form', async function (e) {
        e.preventDefault();
        usedmethod.submitEditForm($('#submit_edit_form'), '/delay_compensation_form_list/update_edit_form', $(this));
    });
    $(document).on('click', '#delete_form_btn', async function (e) {
        usedmethod.deleteForm($(this), '/delay_compensation_form_list/delete_form');
    });
});

