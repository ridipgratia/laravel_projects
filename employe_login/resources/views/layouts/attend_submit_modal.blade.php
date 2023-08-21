<div class="modal fade" id="final_attend_submit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REVIEW APPROVAL DETAILS</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-window-close" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body modal-body_1 ">
                <div class="flex_div attend_submit">
                    <div class="flex_div submit_attend">
                        <div class="flex_div submit_attend_div">
                            <p class="flex_div "><span><i class="fa fa-calendar-day"></i></span><span><i
                                        class="fa fa-calendar-day"></i></span></p>
                        </div>
                        <div class="flex_div submit_attend_div_1">
                            <p class="submit_attend_text" id="office_name">GRATIA</p>
                            <p class="flex_div submit_attend_text submit_attend_time" id="main_time">{{ $date[0] }}
                            </p>
                            <p class="flex_div submit_attend_text submit_attend_date">
                                <span id="day">{{ $date[1] }}</span><span id="year"></span>
                            </p>
                        </div>
                    </div>
                    <div class="flex_div submit_location_div">
                        <p>You Are &nbsp;<span id="meter">100</span>&nbsp; Meter Away From Office.</p>
                        <p>You Are &nbsp;<span id="time">0:29</span>&nbsp;Late Today.</p>
                        <textarea id="attend_textarea" placeholder="give A Reason "></textarea>
                    </div>
                    <div class="flex_div submit_location_div_1">
                        <button id="submit_location_btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
