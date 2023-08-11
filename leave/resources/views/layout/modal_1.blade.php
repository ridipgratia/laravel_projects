<div class="modal
        fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REVIEW APPROVAL DETAILS</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-window-close" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body modal-body_1 ">
                <div class="flex_div review_div">
                    <div class="flex_div review_div_1">
                        <p class="review_para review_para_1">Employe Name</p>
                        <p class="review_para review_para_2">Leave Type</p>
                        <p class="review_para review_para_3">Day Shift</p>
                        <p class="review_text review_para_1">Ridip Goswami</p>
                        <p class="review_text review_para_2">Casual</p>
                        <p class="review_text review_para_3">Full Day</p>
                    </div>
                    <div class="flex_div review_div_1">
                        <p class="review_para review_para_4">From Date</p>
                        <p class="review_para review_para_4">To Date</p>
                        <p class="flex_div review_para review_para_3"><span class="review_span">Unpaid</span>&nbsp;<span
                                class="review_span">Paid</span></p>
                        <p class="review_text review_para_4">10-02-2023</p>
                        <p class="review_text review_para_4">12-02-2023</p>
                        <p class="flex_div review_text review_para_3"><span class="review_span">Unpaid</span>&nbsp;<span
                                class="review_span">Paid</span></p>
                    </div>
                    <div class="flex_div review_div_1">
                        <p class="review_para review_para_1">Reason</p>
                        <p class="review_para review_para_3">No. Days</p>
                        <p class="review_para review_para_3">Medical</p>
                        <p class="review_text review_para_1">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Minima fuga deleniti ab!</p>
                        <p class="review_text review_para_3">12</p>
                        <button class="review_text review_para_3" id="review_btn">View</button>
                    </div>
                    @if ($action != 'none')
                        @include('layout.modal_action_btn')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
