<div class="flex_div main_leave_his_div">
    <div class="flex_div leave_his_div">
        <div class="flex_div leave_his_head_div">
            <p class="leave_his_head_para">LEAVE HISTORY DETAILS</p>
            <div class="flex_div leave_his_head_date">
                <p class="leave_his_head_date_p">Select Month :</p>
                <select name="month" id="leave_his_select">
                    @php
                        
                    @endphp
                    @for ($i = 1; $i <= 12; $i++)
                        @if ($i == $current_month)
                            <option value="{{ $i }}" selected>{{ $i }}</option>
                        @else{
                            <option value="{{ $i }}">{{ $i }}</option>
                            }
                        @endif
                    @endfor
                </select>
            </div>
            <div class="flex_div leave_his_head_date ">
                <p class="leave_his_head_date_p">Select Date :</p>
                <input type="date" id="leave_his_date">
            </div>
        </div>
        <div class="flex_div leave_his_data_div leave_his_class_1">
            <div class="flex_div leave_his_data_div_1">
                <p class="leave_his_data_para si_para">SI No</p>
                <p class="leave_his_data_para leave_para">Leave</p>
                <p class="leave_his_data_para from_date">Form Date</p>
                <p class="leave_his_data_para to_date">To Date</p>
                <p class="leave_his_data_para status">Status</p>
                <p class="leave_his_data_para actions">Actions</p>
            </div>
            <div class="flex_div leave_his_data_div_2">
                @php
                    $count = 1;
                @endphp
                @foreach ($all_leave_data as $leave_data)
                    @foreach ($leave_data as $l_data)
                        <div class="flex_div leave_his_data_div_3">
                            <p class="leave_his_data_para_1 si_para">{{ $count }}</p>
                            <p class="leave_his_data_para_1 leave_para">{{ $l_data->leave_name }}</p>
                            <p class="leave_his_data_para_1 from_date">{{ $l_data->form_date }}</p>
                            <p class="leave_his_data_para_1 to_date">{{ $l_data->to_date }}</p>
                            @php
                                $approval_text = '';
                                if ($l_data->approval_status === null) {
                                    $approval_text = 'Waiting';
                                } elseif ($l_data->approval_status == 1) {
                                    $approval_text = 'Approved';
                                } elseif ($l_data->approval_status == 0) {
                                    $approval_text = 'Rejected';
                                }
                            @endphp
                            <p class="leave_his_data_para_1 status">{{ $approval_text }}</p>
                            <div class="flex_div actions">
                                <button class="leave_action_btn" id="leave_action_remove" value="{{ $l_data->id }}"><i
                                        class="fa fa-trash"></i></button>
                                <button class="leave_action_btn" id="leave_action_view" value="{{ $l_data->id }}"><i
                                        class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
