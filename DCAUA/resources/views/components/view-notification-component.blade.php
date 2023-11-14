<div class="d-flex col-md-8 col-12 main_view_notify_div">
    <div class="d-flex flex-wrap  col-12  send_notification_div_1 ">
        <div class="d-flex flex-wrap col-12 justify-content-center send_notification_div_2">
            <p>Sent Notification</p>
            <p>From: {{ Auth::user()->login_email }}</p>
        </div>
        <div class="d-flex  col-12 justify-content-center send_notification_div_3">
            <div class="d-flex flex-wrap col-md-8 col-11 justify-content-center send_notify_div_1">
                <div class="d-flex col-md-6 col-12 flex-wrap send_notify_div_2">
                    <p class="col-11">District Name</p>
                    <input type="text" class="col-11" disabled>
                </div>
                <div class="d-flex col-md-6 col-12 flex-wrap send_notify_div_2">
                    <p class="col-11">Block Name</p>
                    <input type="text" disabled class="col-11">
                </div>
                <div class="d-flex col-md-8 col-12 justify-content-center flex-wrap send_notify_div_2">
                    <button class="col-6 p-2"><i class="fa-solid fa-file"></i> View Document</button>
                </div>
                <div class="d-flex col-md-11 col-12 flex-wrap send_notify_div_2">
                    <p class="col-11">Your Discription</p>
                    <textarea class="col-12" name="" id="" disabled></textarea>
                </div>
                <button class="col-3 send_notify_btn">Close...</button>
            </div>
        </div>
    </div>
</div>
