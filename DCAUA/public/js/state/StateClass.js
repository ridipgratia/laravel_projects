class StateClass {
    constructor(url, view_url) {
        this.url = url;
        this.view_url = view_url;
    }

    // Initialze datatable Here 

    // Ftech data Fromdatabase And Insert Data In Data Table For Add FTO
    async preLoadFormList() {
        await $.ajax({
            type: "get",
            url: this.url,
            beforeSend: function () {
                console.log("Loading");
            },
            success: function (result) {
                var dataTable = $('#users-table').DataTable();
                dataTable.clear().draw();
                for (var i = 0; i < result.message.length; i++) {
                    dataTable.row.add([(i + 1), result.message[i].name, result.message[i].deginations, result.message[i].registration_id, `<p><button class="col-12 p-1 mb-1 btn btn-primary state_list_view_btn" value="${result.message[i].id}">View</button><br><button class="col-12 p-1 mb-1 btn btn-warning state_list_reset_btn" value="${result.message[i].id}">Reset</button></p>`]).draw(false);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    async viewStateUser(id) {
        console.log(id);
        $.ajax({
            type: "get",
            url: this.view_url,
            data: {
                id: id
            },
            datatype: "html",
            beforeSend: function () {
                console.log("Load State View data");
            },
            success: function (result) {
                $('#state_user_view_div').html(result.content);
                $('#state_user_view_modal').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}
export default StateClass;