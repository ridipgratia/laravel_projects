<div class="col d-flex justify-content-center align-items-center p-0 bg-primary" style="height:80px;">
    <div class="d-flex col-2 justify-content-start">
        <img src="{{ asset('images/logo.png') }}" alt="" style="width:70px;height:70px">
    </div>
    {{-- <div class="d-flex col-2 justify-content-start">
        <img src="{{ asset('images/logo_2.png') }}" alt="" style="width:100px;height:100px">
    </div> --}}
    <div class="d-flex justify-content-end col-5 ">
        @if (Auth::user()->role == 1)
            @php
                $role = 'Block ';
            @endphp
        @elseif (Auth::user()->role == 3)
            <a href="/state_dash">State Dashbard</a>
            @php
                $role = 'State';
            @endphp
        @else
            <a href="">Error Route</a>
        @endif
        @php
            $login_id = str_replace('_', ' ', Auth::user()->login_id);
        @endphp
        <h4 class="text-white me-3 fs-6">WELCOME {{ $login_id }} ( {{ $role }} )</h4>
        <a href="/logout" class="text-white fs-6"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</div>
