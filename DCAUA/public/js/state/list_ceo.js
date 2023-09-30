import StateClass from "./StateClass.js";
$(document).ready(function () {
    var url = "/list_ceo/for_table";
    var view_url = "/list_ceo/view_data";
    var reset_pass_url = "/list_ceo/reset_pass";
    var remove_user_url = "/list_ceo/remove_user";
    const stateclass = new StateClass(url, view_url, reset_pass_url, remove_user_url);
    stateclass.preLoadFormList();
    $(document).on('click', '.state_list_view_btn', function () {
        var id = $(this).val();
        stateclass.viewStateUser(id);
    });
    // Display Reset Password Modal
    $(document).on('click', '.state_list_reset_btn', function () {
        var id = $(this).val();
        $('#state_user_pass_reset').modal('show');
        $('#state_user_pass_reset_submit').val(id);
    });
    // Reset User Pass
    $(document).on('click', '#state_user_pass_reset_submit', function () {
        var id = $(this).val();
        stateclass.resetStateUserPass(id, $(this));
    });
    // Reset Password
    $(document).on('click', '.state_list_remove_btn', function () {
        var id = $(this).val();
        stateclass.removeUser(id, $(this));
    });
});