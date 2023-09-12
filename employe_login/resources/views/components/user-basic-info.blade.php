<div class="flex_div user_basic_info_div">
    <p class="error error_2">* Verication Link Is Expire</p>
    <h1 class="user_info_head">General Infomation</h1>
    <form class="flex_div user_basic_info_div_1" id="change_basic_form">
        @csrf

        <div class="flex_div user_basic_info">
            <p>Your Name :</p>
            <div class="flex_div user_basic_int_div">
                <span><i class="fa fa-user"></i></span>
                <input type="text" name="user_name" value="{{ $user_basic_info[0]->employe_name }}">
            </div>
        </div>
        <div class="flex_div user_basic_info">
            <p>Your Email ID :</p>
            <div class="flex_div user_basic_int_div">
                <span><i class="fa fa-envelope"></i></span>
                <input type="email" name="user_email" value="{{ $user_basic_info[0]->email }}">
            </div>
        </div>
        <div class="flex_div user_basic_info">
            <p>Your Phone No :</p>
            <div class="flex_div user_basic_int_div">
                <span><i class="fa fa-phone"></i></span>
                <input type="number" name="user_phone" value="{{ $user_basic_info[0]->phone }}">
            </div>
        </div>

        <div class="flex_div user_basic_info_1">
            <button id="user_basic_btn">Save All</button>
        </div>
    </form>
</div>
