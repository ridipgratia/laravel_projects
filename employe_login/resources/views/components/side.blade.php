<div class="flex_div top_side_nav">
    <h1 class="top_company_name">Company Name</h1>
    <div class="flex_div menu_nav_btn">
        <button onclick="menu_btn_fun()"><i class="fa fa-bars"></i></button>
    </div>
</div>
<div class="flex_div main_side_nav_div">
    <p class="flex_div nav_close" onclick="menu_side_close()"><i class="fa fa-times" aria-hidden="true"></i>
    </p>
    <h1 class="compnay_name">Company Name</h1>
    <div class="flex_div side_nav_text">
        <div class="flex_div side_nav_head">
            @php
                $emp_name_arr = explode(' ', $employe_name);
                $emp_name = '';
                if (count($emp_name_arr) >= 2) {
                    $emp_name = $emp_name_arr[0][0] . $emp_name_arr[1][0];
                } else {
                    $emp_name = $emp_name_arr[0][0];
                }
            @endphp
            <p class="circle_text" style="text-transform: uppercase">{{ $emp_name }}</p>
            <a href="{{ route('logout') }}" id="log_out"><i class="fas fa-sign-out-alt"></i> </a>
        </div>
        <p class="user_text">{{ $emp_code }}</p>
        <p class="user_text">ridipgoswami147@gmail.com</p>
    </div>
    <div class="flex_div side_nav_link">
        <a href="home" class="flex_div side_nav_a"><span><i class="fa fa-user"></i> </span>
            <span>Profile </span></a>
        <a href="{{ route('dashboard') }}" class="flex_div side_nav_a"><span><i class="fa fa-info"></i> </span>
            <span>Basic
                Information</span></a>
        <a href="leaveFrom" class="flex_div side_nav_a"><span><i class="fas fa-leave"></i> </span>
            <span>Leave Apply</span></a>
        <a href="attendance" class="flex_div side_nav_a"><span><i class="fas fa-clipboard"></i> </span>
            <span>Attendace History</span></a>
        <a href="" class="flex_div side_nav_a"><span><i class="fas fa-pen"></i> </span>
            <span>Modify Information</span></a>
    </div>
</div>
