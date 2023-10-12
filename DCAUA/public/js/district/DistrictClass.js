class DistrictClass {
    constructor() {

    }
    async preloadData(url) {
        $.ajax({
            type: "get",
            url: url,
            beforeSend: function () {
                console.log("Loading");
            },
            success: function (result) {
                var dataTable = $('#users-table').DataTable();
                dataTable.clear().draw();
                var approval_status = null;
                for (var i = 0; i < result.message.length; i++) {
                    approval_status = null;
                    if (result.message[i].approval_status == 0) {
                        approval_status = "Waiting";
                    }
                    else if (result.message[i].approval_status == 1) {
                        approval_status = "Approved";
                    }
                    else if (result.message[i].approval_status == 2) {
                        approval_status = "Rejected";
                    }
                    dataTable.row.add([(i + 1), result.message[i].request_id, result.message[i].date_of_submit, approval_status, `<button id='district_delay_form_btn' class="btn btn-primary" value="${result.message[i].id}">View</button>`]).draw(false);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    async viewFormData(url, btn) {
        var delay_form_id = btn.val();
        $.ajax({
            type: "get",
            url: url,
            data: {
                delay_form_id: delay_form_id
            },
            datatype: "html",
            success: function (result) {
                if (result.status == 200) {
                    $('.delay_show_div_1').eq(0).html(result.message);
                    $('#show_delay_form_data').modal('show')
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
    }
    async serachByDates(url, event) {
        var form_data = new FormData($('#serach_form_date')[0]);
        event.preventDefault()
        $.ajax({
            type: "post",
            url: url,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.status == 200) {
                    var dataTable = $('#users-table').DataTable();
                    dataTable.clear().draw();
                    var incre = 1;
                    var approval_status = null;
                    for (var i = 0; i < result.message.length; i++) {
                        for (var j = 0; j < result.message[i].length; j++) {
                            approval_status = null;
                            if (result.message[i][j].approval_status == 0) {
                                approval_status = "Waiting";
                            }
                            else if (result.message[i][j].approval_status == 1) {
                                approval_status = "Approved";
                            }
                            else if (result.message[i][j].approval_status == 2) {
                                approval_status = "Rejected";
                            }
                            dataTable.row.add([incre, result.message[i][j].request_id, result.message[i][j].date_of_submit, approval_status, `<button id='district_delay_form_btn' class="btn btn-primary" value="${result.message[i][j].id}">View</button>`]).draw(false);
                            incre++;
                        }
                    }
                }
                else {
                    Swal.fire(
                        "Error",
                        result.message,
                        'error'
                    )
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}
export default DistrictClass;