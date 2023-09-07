<div class="fle_div user_side_info">
    <img src="{{ asset('images/user_side_info.jpg') }}" class="user_side_img" alt="">
    <div class="flex_div user_side_info_div">
        <img src="{{ asset('images/user.jpg') }}" id="user_image" alt="">
        <input type="file" id="user_select_image" style="display: none">
        <button id="user_side_select"><i class="fa fa-folder-open"></i></button>
    </div>
    <div class="flex_div user_side_info_div_1">
        <p>{{ $userSideInfo[0]->designation_name }}</p>
        <p>{{ $userSideInfo[0]->email }}</p>
        <p>GRATIA</p>
        <button>Contact Admin</button>
    </div>
</div>
