<div class="flex_div user_side_res">
    <button class="user_side_icon"><i class="fa fa-user"></i></button>
</div>
<div class="fle_div user_side_info">

    <form class="flex_div user_side_res_hide" id="employe_profile_form">
        @csrf
        <img src="{{ asset('images/user_side_info.jpg') }}" class="user_side_img" alt="">
        <div class="flex_div user_side_info_div">
            @if ($userSideInfo[0]->employe_profile == null)
                <img src="{{ asset('images/user.jpg') }}" id="user_image" alt="">
            @else
                <img src="{{ Storage::url($userSideInfo[0]->employe_profile) }}" id="user_image" alt="">
            @endif
            <input type="file" id="user_select_image" style="display: none" name="employe_profile">
            <button type="button" id="user_side_select"><i class="fa fa-folder-open"></i></button>
        </div>
        <div class="flex_div close_side_info">
            <button type="button" id="close_side_int_btn"><i class="fa fa-minus"></i></button>
        </div>
        <div class="flex_div user_side_info_div_1">
            <p>{{ $userSideInfo[0]->designation_name }}</p>
            <p>{{ $userSideInfo[0]->email }}</p>
            <p>GRATIA</p>
            <button type="submit" id="user_profile_btn">Update Profile</button>
        </div>
    </form>

</div>
