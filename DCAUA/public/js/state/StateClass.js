class StateClass {
    constructor(url, view_url, reset_pass_url, remove_user_url, edit_user_url, edit_user_submit_url) {
        this.url = url;
        this.view_url = view_url;
        this.reset_pass_url = reset_pass_url;
        this.remove_user_url = remove_user_url;
        this.edit_user_url = edit_user_url;
        this.edit_user_submit_url = edit_user_submit_url;

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
                    dataTable.row.add([(i + 1), result.message[i].name, result.message[i].deginations, result.message[i].record_id, `<p class="table_button d-flex "><button class=" col-3 state_list_view_btn" value="${result.message[i].id}"><i class="fa fa-eye"></i></button><button class="col-3 state_list_reset_btn" value="${result.message[i].id}"><i class=" fa-solid fa-lock"></i></button><button class="col-3 state_list_edit_btn " value="${result.message[i].id}"><i class=" fa-solid fa-pen-to-square"></i></button><button class="col-3 state_list_remove_btn " value="${result.message[i].id}"><i class=" fa-solid fa-trash"></i></button></p>`]).draw(false);
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
    async editUser(id, event) {
        event.attr('disabled', true);
        $.ajax({
            type: "get",
            url: this.edit_user_url,
            data: {
                id: id
            },
            success: function (result) {
                if (result.status == 200) {
                    console.log($('.input_data').eq(0).val());
                    $('.input_data').eq(0).val(result.message[0].name);
                    $('.input_data').eq(1).val(result.message[0].phone);
                    $('.input_data').eq(2).val(result.message[0].email);
                    $('.input_data').eq(3).val(result.message[0].deginations);
                    $('.input_data').eq(4).val(result.message[0].code_id);
                    $('#edit_user_btn').val(id);
                } else {
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
    async editUserSubmit(form, id) {
        var form_data = new FormData($(form)[0]);
        form_data.append('id', id);
        $('#edit_user_btn').attr('disabled', true);
        $.ajax({
            type: "post",
            url: this.edit_user_submit_url,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.status == 400) {
                    Swal.fire(
                        'Information',
                        result.message,
                        "info"
                    )
                }
                else {
                    Swal.fire(
                        'Information',
                        result.message,
                        "success"
                    )
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        $('#edit_user_btn').attr('disabled', false);
    }
}
export default StateClass;