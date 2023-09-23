$(document).ready(function () {
    $('#users-table').DataTable({
        colReorder: true,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'csvHtml5',
            text: 'Export CSV',
            className: 'csv_buttonbtn btn-default widthFix',
            messageTop: 'PDF created by PDFMake with Buttons for DataTables.',
            exportOptions: {
                columns: [0, 1, 2, 3],
            },
            init: function (api, node, config) {
                // $(node).removeClass('.btn')
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'Export PDF',
            className: 'pdf_button',
            messageTop: 'PDF created by PDFMake with Buttons for DataTables.',
            exportOptions: {
                columns: [0, 1, 2, 3],
            },
        },
        {
            extend: 'copyHtml5',
            text: 'Copy Data',
            messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
        },
        ]

    });
    preLoadFormList();
    async function preLoadFormList() {
        $.ajax({
            type: "get",
            url: "/unemp_alowance_form_list/form_list",
            beforeSend: function () {
                console.log("Loading");
            },
            success: function (result) {
                var dataTable = $('#users-table').DataTable();
                dataTable.clear().draw();
                for (var i = 0; i < result.message.length; i++) {
                    $approval_status = null;
                    if (result.message[i].approval_status == 0) {
                        $approval_status = "Waiting";
                    }
                    else if (result.message[i].approval_status == 1) {
                        $approval_status = "Approved";
                    }
                    else if (result.message[i].approval_status == 2) {
                        $approval_status = "Rejected";
                    }
                    dataTable.row.add([(i + 1), result.message[i].request_id, result.message[i].date_of_submite, $approval_status, `<button id='unemp_allow_show_btn' value="${result.message[i].id}">View</button>`]).draw(false);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    $('#close_emp_form').on('click', function () {
        $('#show_unemp_allow_form_data').modal('hide');
    });
    $(document).on('click', '#unemp_allow_show_btn', async function () {
        $unemp_allow_form_id = $(this).val();
        // $.ajax({
        //     type: "get",
        //     url: "delay_compensation_form_list/form_data",
        //     datatype: "html",
        //     beforeSend: function () {
        //         console.log($(this).val)
        //         console.log("Loading");
        //     }
        // }).done(function (result) {
        //     $('.delay_show_div_1').eq(0).html(result);
        //     $('#show_delay_form_data').modal('show');
        // });
        // console.log($(this).val());
        $.ajax({
            type: "get",
            url: "unemp_alowance_form_list/form_data",
            data: {
                unemp_allow_form_id: $unemp_allow_form_id
            },
            datatype: 'html',
            success: function (result) {
                $('.unemp_allow_show_div_1').eq(0).html(result);
                $('#show_unemp_allow_form_data').modal('show')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});