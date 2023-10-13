import DistrictClass from "./DistrictClass.js";
const districtclass = new DistrictClass();
$(document).ready(function () {
    $('#users-table').DataTable({
        colReorder: true,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'csvHtml5',
            text: 'Export CSV',
            className: 'csv_buttonbtn btn-default widthFix ',
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
    // Load Delay Form Data When Page Open

    districtclass.preloadData('/district_delay_com/form_list', 'add_dc');

    // View All Data By ID

    $(document).on('click', '#district_delay_form_btn', function () {
        districtclass.viewFormData("/district_delay_com/form_data", $(this));
    });

    // View Delay Document 
    $(document).on('click', '#show_form_document', function () {
        var $link = $(this).val();
        window.open($link, 'Document');
    });
    // Serach By Dates 
    $('#serach_form_date').on('submit', async function (e) {
        districtclass.serachByDates('/district_delay_com/serach_data', e);
    });
    // Get Gp Names By Blocks 
    $(document).on('change', '#change_block_id', function () {
        var block_id = $(this).val();
        districtclass.getGpByBlock('district_unemp_allow/get_gp_by_block', block_id);
    });
    // Serach Block , Gp And Dates
    $(document).on('submit', '#search_date_block_gp_id', function (e) {
        districtclass.serachBlockGpDates('district_delay_com/search_block_gp_dates', e);
    })
})