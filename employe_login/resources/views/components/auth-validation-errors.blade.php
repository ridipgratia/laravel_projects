@props(['errors'])
@if ($errors->any())
    <div class="flex_div error_div">
        @foreach ($errors->all() as $error)
            <p class="flex_div "><span class="error_span_1"><i class="fa-solid fa-exclamation"></i></span> <span
                    class="error_span_2">
                    {{ $error }} </span>
                <span class="error_span_3"> <i class="fa fa-window-close"></i></span>
        @endforeach
    </div>
@endif
