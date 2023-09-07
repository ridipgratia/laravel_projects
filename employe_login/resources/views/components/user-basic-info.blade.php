<div class="flex_div user_basic_info_div">
    <h1 class="user_info_head">General Infomation</h1>
    <form class="flex_div user_basic_info_div_1">
        <div class="flex_div user_basic_info">
            <p>Your Name :</p>
            <input type="text" name="user_name" value="{{ $user_basic_info[0]->employe_name }}">
        </div>
        <div class="flex_div user_basic_info">
            <p>Your Email ID :</p>
            <input type="email" name="user_email" value="{{ $user_basic_info[0]->email }}">
        </div>
        <div class="flex_div user_basic_info">
            <p>Your Phone No :</p>
            <input type="number" name="user_phone" value="{{ $user_basic_info[0]->phone }}">
        </div>
        <div class="flex_div user_basic_info">
            <p>Your Phone No :</p>
            <input type="number" name="user_phone" readonly>
        </div>
        <div class="flex_div user_basic_info_1">
            <button id="user_basic_btn">Save All</button>
        </div>
    </form>
</div>
