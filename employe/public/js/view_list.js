function child_have_fun() {
    var child_have_check = document.getElementById('child_have_check');
    var child_have_btn = document.getElementById('child_have_btn');
    var child_upload_div = document.getElementsByClassName('child_upload_div')[0];
    var child_upload_div_2 = document.getElementsByClassName('child_have_div_2')[0];
    var child_have_btn_1 = document.getElementById('child_have_btn_1');
    var child_have_check_no = document.getElementById('child_have_check_no');
    if (child_have_check.checked == true) {
        child_have_btn.style.display = "block";
        child_upload_div_2.style.display = "none";
        child_have_btn_1.style.display = "none";
        child_have_check_no.checked = false;
    } else {
        child_have_btn.style.display = "none";
        child_upload_div.style.display = "none";
        child_upload_div_2.style.display = "flex";
    }
}

function child_have_fun_1() {
    var child_upload_div = document.getElementsByClassName('child_upload_div')[0];
    child_upload_div.style.display = "flex";
}

// function submit_info() {
//     var child_name = document.getElementsByClassName('child_name');
//     var child_dob = document.getElementsByClassName('child_dob');
//     var education = document.getElementsByClassName('education');
//     var child_gender = document.getElementsByClassName('child_gender');
//     var modal_body = document.getElementsByClassName('modal-body')[0];
//     var content_div = document.getElementsByClassName('content_div')[0];
//     if (content_div) {
//         modal_body.removeChild(content_div);
//     }
//     var main_div = document.createElement('div');
//     main_div.setAttribute('class', 'flex_div content_div');
//     modal_body.appendChild(main_div);
//     for (var i = 0; i < child_name.length; i++) {
//         var content_span = document.createElement('div');
//         content_span.setAttribute('class', 'flex_div content_span');
//         main_div.appendChild(content_span);
//         var content_para = document.createElement('div');
//         content_para.setAttribute('class', 'flex_div content_para');
//         main_div.appendChild(content_para);
//         var span = document.createElement('span');
//         span.innerHTML = (i + 1);
//         content_span.appendChild(span);
//         var para = document.createElement('p');
//         para.innerHTML = child_name[i].value;
//         content_para.appendChild(para);
//         var para = document.createElement('p');
//         para.innerHTML = child_dob[i].value;
//         content_para.appendChild(para);
//         var para = document.createElement('p');
//         para.innerHTML = education[i].value;
//         content_para.appendChild(para);
//         var para = document.createElement('p');
//         para.innerHTML = child_gender[i].value;
//         content_para.appendChild(para);
//         var cner
//     }
// }
function submit_info() {
    if ($('.content_div').length != 0) {
        $('.content_div').remove();
    }
    $('.modal-body').append('<div class="flex_div content_div"></div>')
    var child_length = $('.child_name').length;
    for (var i = 0; i < child_length; i++) {
        $('.content_div').append('<div class="flex_div content_para_div"><p class="flex_div content_para"><span>Child ' + (i + 1) + '</span></p><p class="flex_div content_para_1"><span>Name</span><span>' + $('.child_name').eq(i).val() + '</span></p> <p class="flex_div content_para_1"><span>D.O.B</span><span>' + $('.child_dob').eq(i).val() + '</span></p> <p class="flex_div content_para_1"><span>School/College</span><span>' + $('.education').eq(i).val() + '</span></p> <p class="flex_div content_para_1"><span>Gender</span><span>' + $('.child_gender').eq(i).val() + '</span></p> </div>')
    }
}

function child_have_no_fun() {
    var child_have_check = document.getElementById('child_have_check');
    var child_have_check_no = document.getElementById('child_have_check_no');
    var child_have_btn = document.getElementById('child_have_btn');
    var child_have_btn_1 = document.getElementById('child_have_btn_1');
    var child_upload_div = document.getElementsByClassName('child_upload_div')[0];
    var child_have_check = document.getElementById('child_have_check');
    if (child_have_check_no.checked == true) {
        child_have_btn_1.style.display = "block";
        child_upload_div.style.display = "none";
        child_have_btn.style.display = "none";
        child_have_check.checked = false;
    } else {
        child_have_btn_1.style.display = "none";
    }
}
$(document).ready(function () {
    $(document).on('click', '#check_disbaled', function () {
        $check_id = $(this).val();
        console.log($check_id);
        check = false;
        if ($(this).is(":checked")) {
            check = true;
        } else {
            check = false;
        }
        $.ajax({
            type: "get",
            url: "view_list/check_disabled",
            data: {
                check: check
            },
            datatype: "html",
            beforeSend: function () {
                $tag_content = '<p class="loading_text">Loading</p>'
                $('#' + $check_id).html($tag_content);
            }
        }).done(function (result) {
            $('#' + $check_id).html(result);
        })
    })
    $(document).on('click', '.child_remove', function () {
        $td_row_length = $('.td_row').length;
        $row_name = $(this).val();
        $('#row' + $row_name).remove();
        $rowno = $('#employe_table tr').length;
        $('#no_child_span').html($rowno);
        for (var i = 1; i < $td_row_length; i++) {
            id = i + 1;
            $('.td_row').eq(i).attr('id', 'row' + id);
            $('.count_disabled').eq(i).val('disabled_div_' + id);
            $('.dis_file').eq(i).attr('id', 'disabled_div_' + id)
            $('.child_remove').eq(i - 1).val(id);
        }
    })

})
