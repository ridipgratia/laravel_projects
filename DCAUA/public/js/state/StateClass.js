class StateClass {
    constructor(url, view_url, reset_pass_url, remove_user_url) {
        this.url = url;
        this.view_url = view_url;
        this.reset_pass_url = reset_pass_url;
        this.remove_user_url = remove_user_url;

        $('#state_user_edit_modal').modal('show');
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
                    dataTable.row.add([(i + 1), result.message[i].name, result.message[i].deginations, result.message[i].registration_id, `<p class="btn_groups d-flex  "><button class="col-3 state_list_view_btn" value="${result.message[i].id}"><i class="btn btn-primary fa fa-eye"></i></button><button class="col-3 state_list_reset_btn" value="${result.message[i].id}"><i class="btn btn-secondary fa-solid fa-arrows-rotate"></i></button><button class="col-3 " value="${result.message[i].id}"><i class="btn btn-warning fa-solid fa-pen-to-square"></i></button><button class="col-3 state_list_remove_btn " value="${result.message[i].id}"><i class="btn btn-danger fa-solid fa-trash"></i></button></p>`]).draw(false);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    // View User Data By Create State 

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

    // Reset User Password By Created State
    async resetStateUserPass(id, event) {
        var password = $('#reset_password').val();
        event.attr('disabled', true);
        $.ajax({
            type: "get",
            url: this.reset_pass_url,
            data: {
                id: id,
                password: password
            },
            success: function (result) {
                if (result.status == 200) {
                    Swal.fire(
                        "Success",
                        result.message,
                        "success"
                    )
                }
                else {
                    Swal.fire(
                        "Information",
                        result.message,
                        "info"
                    )
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        event.attr('disabled', false);
    }

    // Remove CEO PD User Data
    async removeUser(id, event) {
        event.attr('disabled', true);
        console.log(id);
        $.ajax({
            type: "get",
            url: this.remove_user_url,
            data: {
                id: id
            },
            success: function (result) {
                if (result.status == 200) {
                    Swal.fire(
                        "Success",
                        result.message,
                        "success"
                    ).then(() => {
                        location.reload();
                    })
                }
                else {
                    Swal.fire(
                        "Information",
                        result.message,
                        "info"
                    )
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        event.attr('disabled', false);
    }

}
export default StateClass;