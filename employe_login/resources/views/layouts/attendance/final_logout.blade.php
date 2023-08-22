<div class="modal fade" id="final_logout_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout Panel</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-window-close" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body modal-body_1 ">
                <div class="flex_div attend_submit">
                    <div class="flex_div submit_attend">
                        <div class="flex_div submit_attend_div">
                            <p class="flex_div "><span><i class="fa fa-calendar-day"></i></span><span><i
                                        class="fa fa-calendar-day"></i></span>
                            </p>
                        </div>
                        <div class="flex_div submit_attend_div_1">
                            <p class="submit_attend_text" id="Logout_office_name">GRATIA</p>
                            <p class="flex_div submit_attend_text submit_attend_time" id="Logout_main_time">
                                {{ $date[0] }}
                            </p>
                            <p class="flex_div submit_attend_text submit_attend_date">
                                <span id="Logout_day">{{ $date[1] }}</span><span id="Logout_year"></span>
                            </p>
                        </div>
                    </div>

                    <div class="flex_div logout_final_div">
                        <p class="logout_final_p">You Are <span id="Logout_meter">100</span>Away From Office</p>
                        <div class="flex_div logout_final_btn_div">
                            <button class="logout_final_btn" onclick="final_cancel_btn()">Cancel</button>
                            <button class="logout_final_btn" id="final_logout_submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
