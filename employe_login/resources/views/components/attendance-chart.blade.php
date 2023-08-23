<div class="flex_div chart_div">
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    <div class="flex_div attend_data">
        @php
            $present_day = ($present[0] / 100) * $present[3];
            $absent = ($present[1] / 100) * $present[3];
            $absent = number_format($absent);
        @endphp
        <p class="attend_data_text"><span id="present">{{ $present_day }}</span> Days present in <span
                class="month">{{ $present[2] }}</span> month. </p>
        <p class="attend_data_text"><span id="absent">{{ $absent }}</span> Days absent in <span
                class="month">{{ $present[2] }}</span> month.</p>
    </div>
</div>
