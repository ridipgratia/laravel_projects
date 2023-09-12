<div class="flex_div change_password_div">
    <form class="flex_div change_password_div_1" id="change_pass_form">
        @csrf
        <p>Old Password</p>
        <div class="flex_div change_password_int_div">
            <span><i class="fa fa-lock"></i></span>
            <input type="password" name="user_old_pass" class="pass_int">
            <span onclick="check_input_type(0)"><i class="fa fa-eye"></i></span>
        </div>
        <p>New Password</p>
        <div class="flex_div change_password_int_div">
            <span><i class="fa fa-lock"></i></span>
            <input type="password" name="user_new_pass" class="pass_int">
            <span onclick="check_input_type(1)"><i class="fa fa-eye"></i></span>
        </div>
        <button id="change_pass_btn" type="submit">Chnage Password</button>
        <p class="error error_1">* Verication Link Is Expire</p>
    </form>
</div>
