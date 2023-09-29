import StateClass from "./StateClass.js";
$(document).ready(function () {
    var url = "/list_ceo/for_table";
    var view_url = "/list_ceo/view_data";
    const stateclass = new StateClass(url, view_url);
    stateclass.preLoadFormList();
    $(document).on('click', '.state_list_view_btn', function () {
        var id = $(this).val();
        stateclass.viewStateUser(id);
    })
});