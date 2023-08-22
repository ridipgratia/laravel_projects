<div class="modal fade" id="attend_location_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attendance Locations</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-window-close" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body modal-body_1 ">
                <div class="flex_div home_attend">
                    <div class="flex_div home_attend_div_1">
                        <h1>Give Attendance </h1>
                        <p>Choose Your Office Location Here .</p>
                    </div>
                    <div class="flex_div home_attend_div_2">
                        @foreach ($locations as $location)
                            <div class="flex_div home_attend_card">
                                <p class="attend_icon"><i class="fa fa-building"></i></p>
                                <p class="attend_text office_name">{{ $location->office_name }}</p>
                                <p class="attend_text office_location">{{ $location->location_name }}</p>
                                <button class="office_btn" id="{{ $atten_button[2] }}" value={{ $location->id }}>Give
                                    Attendance</button>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
