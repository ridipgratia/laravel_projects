$(document).on('click', '#left', function () {
    $right = $('.designation_div').scrollLeft() + screen.width - 350;
    $('.designation_div').animate({
        scrollLeft: $right
    }, 400);
})
$(document).on('click', '#right', function () {
    $left = $('.designation_div').scrollLeft() - screen.width + 350;
    $('.designation_div').animate({
        scrollLeft: $left
    }, 400);
})



function fun() {
    $('.designation_div').css('overflow', 'hidden');
}
$(document).ready(function () {
    $('.dt-buttons').html('Ok');
    $('#users-table').DataTable({
        colReorder: true,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                text: 'Export CSV',
                className: 'csv_buttonbtn btn-default widthFix',
                messageTop: 'PDF created by PDFMake with Buttons for DataTables.',
                init: function (api, node, config) {
                    $(node).removeClass('.dt-button')
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Export PDF',
                className: 'pdf_button',
                messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
            },
            {
                extend: 'copyHtml5',
                text: 'Copy Data',
                messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
            },
        ]
    });
    $.ajax({
        type: "GET",
        url: "admin_registration/employe_data",
        data: {
            action: true
        },
        success: function (result) {
            var dataTable = $('#users-table').DataTable();

            dataTable.clear().draw();
            for (var i = 0; i < result.employe_data.length; i++) {
                dataTable.row.add([(i + 1), result.employe_data[i].emp_code, result.employe_data[i].employe_name, result.employe_data[i].designation_name, result.employe_data[i].phone, result.employe_data[i].email, '<button class="action_btn" value="' + result.employe_data[i].id + '"> View </button>']).draw(false);
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
    $(document).on('click', '.action_btn', async function () {
        $employe_id = $(this).val();
        await $.ajax({
            type: 'GET',
            url: 'admin_registration/all_employe_data',
            data: {
                employe_id: $employe_id
            },
            success: async function (result) {
                if (result.status == 200) {
                    await add_element(result.employe_data, result.employe_education, result.exploye_expirience);
                    // $('.step_icon').eq(0).css('border', '1px solid blue');
                    $('.step_icon').eq(0).css('background', 'blue');
                    for (var i = 0; i < $('.step_icon').length; i++) {
                        if (i == 0) {
                            $('.step_icon').eq(0).css('background', 'blue');
                            $('.all_details_div_1').eq(0).css('display', 'flex');
                        } else {
                            $('.step_icon').eq(i).css('background', 'grey');
                            $('.all_details_div_1').eq(i).css('display', 'none');
                        }
                    }
                    $('#exampleModal').modal('show');
                } else {
                    console.log("Error");
                }

            },
            error: function (data) {
                console.log(data);
            }
        })
    })
    async function add_element(data, education_data, exploye_expirience) {
        $('.all_details_span_2').eq(0).html(data[0].emp_code);
        $('.all_details_span_2').eq(1).html(data[0].empoye_name);
        $('.all_details_span_2').eq(2).html(data[0].employe_father_name);
        $('.all_details_span_2').eq(3).html(data[0].employe_mother_name);
        $('.all_details_span_2').eq(4).html(data[0].gender);
        $('.all_details_span_2').eq(5).html(data[0].designation_name);
        $('.all_details_span_2').eq(6).html(data[0].DOB);
        $('.all_details_span_2').eq(7).html(data[0].join_date);
        $('.all_details_span_2').eq(8).html(data[0].phone);
        $('.all_details_span_2').eq(9).html(data[0].email);
        $('.all_details_span_2').eq(10).html(data[0].bank_name);
        $('.all_details_span_2').eq(11).html(data[0].account_no);
        $('.all_details_span_2').eq(12).html(data[0].IFSC_code);
        $('.all_details_span_2').eq(13).html(data[0].branch_name);

        // Educational Details

        $('.education_view_div_1').remove();
        $('.education_view_div').append('<div class="flex_div education_view_div_1"></div>');
        for (var i = 0; i < education_data.length; i++) {
            $('.education_view_div_1').append('<button class="education_btn" value="' + data[0].id + ' ' + education_data[i].id + '">' + education_data[i].board + '</button>');
        }
        if (education_data.length != 0) {
            $('.education_details').eq(0).html(education_data[0].board);
            $('.education_details').eq(1).html(education_data[0].school_college);
            $('.education_details').eq(2).html(education_data[0].degree);
            $('.education_details').eq(3).html(education_data[0].year);
            $('.education_details').eq(4).html(education_data[0].percentage);
            $('.education_details').eq(5).html(education_data[0].marks);
            $('#edu_document').val(education_data[0].education_certificate);
            $('.education_btn').eq(0).css("background", "grey");
        } else {
            for (var i = 0; i < $('.education_details').length; i++) {
                $('.education_details').eq(i).html('');
            }
            $('#edu_document').val('');
        }

        // Expirience Information

        $('.ex_view_div_1').remove();
        $('.ex_view_div').append('<div class="flex_div ex_view_div_1"></div>');
        for (var i = 0; i < exploye_expirience.length; i++) {
            $('.ex_view_div_1').append('<button class="ex_btn" value="' + data[0].id + '">' + exploye_expirience[i].company_name + '</button>');
        }
        if (exploye_expirience.length != 0) {

            $('.ex_para').eq(0).html(exploye_expirience[0].company_name);
            $('.ex_para').eq(1).html(exploye_expirience[0].ex_year);
            $('.ex_para').eq(2).html(exploye_expirience[0].emp_role);
            $('.ex_para').eq(3).html(exploye_expirience[0].to_date);
            $('.ex_para').eq(4).html(exploye_expirience[0].form_date);
            $('#ex_document').val(exploye_expirience[0].ex_certificate);
            $('.ex_btn').eq(0).css("background", "grey");
        } else {
            for (var i = 0; i < $('.ex_para').length; i++) {
                $('.ex_para').eq(i).html('');
            }
            $('#ex_document').val('');
        }

    }
    $(document).on('click', '.education_btn', async function () {
        var btn_text = $(this).val().split(" ");
        await $.ajax({
            type: 'GET',
            url: 'admin_registration/education_details',
            data: {
                employe_id: btn_text[0],
                education_id: btn_text[1]
            },
            success: async function (result) {
                $('.education_details').eq(0).html(result.education_details[0].board);
                $('.education_details').eq(1).html(result.education_details[0].school_college);
                $('.education_details').eq(2).html(result.education_details[0].degree);
                $('.education_details').eq(3).html(result.education_details[0].year);
                $('.education_details').eq(4).html(result.education_details[0].percentage);
                $('.education_details').eq(5).html(result.education_details[0].marks);
                $('#edu_document').val(result.education_details[0].education_certificate);
                for (var i = 0; i < $('.education_btn').length; i++) {
                    if (btn_text[1] == $('.education_btn').eq(i).val().split(" ")[1]) {
                        $('.education_btn').eq(i).css('background', 'grey');
                    } else {
                        $('.education_btn').eq(i).css('background', '#fdfdfd');
                    }
                }

            },
            error: function (data) {
                console.log(data);
            }
        })

    })
    $('#prev_btn').on('click', function () {
        $index = null;
        $div_len = $('.all_details_div_1').length;
        for (var i = ($div_len - 1); i >= 0; i--) {
            if ($('.all_details_div_1').eq(i).is(':visible')) {
                if (i != 0) {
                    $index = i - 1;
                } else {
                    $index = i;
                }
            }
            $('.all_details_div_1').eq(i).css('display', 'none');
            $('.step_icon').eq(i).css('background', 'grey');
        }
        $('.all_details_div_1').eq($index).css('display', 'flex');
        $('.step_icon').eq($index).css('background', 'blue');
    })

    $('#next_btn').on('click', function () {
        $index = null;
        $div_len = $('.all_details_div_1').length;
        for (var i = 0; i < $div_len; i++) {
            if ($('.all_details_div_1').eq(i).is(':visible')) {
                if (i != ($div_len - 1)) {
                    $index = i + 1;
                } else {
                    $index = i;
                }
            }
            $('.all_details_div_1').eq(i).css('display', 'none');
            $('.step_icon').eq(i).css('background', 'grey');
        }
        $('.all_details_div_1').eq($index).css('display', 'flex');
        $('.step_icon').eq($index).css('background', 'blue');
    })
    $(document).on('click', '#edu_document', function () {
        $image_url = $(this).val();
        get_location($image_url);
    })
    $(document).on('click', '#ex_document', async function () {
        $image_url = $(this).val();
        get_location($image_url);
    })
    async function get_location(image_url) {
        $image_url = image_url;
        await $.ajax({
            type: 'GET',
            url: 'admin_registration/file_location',
            data: {
                url: $image_url
            },
            success: function (result) {
                $('#file_frame').attr('src', '');
                if (result.status == 200) {
                    $('#file_frame').attr('src', result.image_url)
                    $('#show_file').modal('show');
                } else {
                    alert("No File Found ");
                }
            },
            error: function (data) {
                console.log(data);
            }
        })
    }
    $('#close_file').on('click', function () {
        $('#show_file').modal('hide');
        $('#exampleModal').css('overflow-y', 'auto');
    })
    // $('.view_btn').on('click', function () {
    //     if ($('#all_details_1').is(":visible")) {
    //         console.log("Visible");
    //     } else {
    //         console.log("Ok");
    //     }
    // })

})
