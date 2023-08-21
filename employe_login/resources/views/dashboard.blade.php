<x-app-layout content="hello">
    <x-slot name="login_emp_code">
        <p class="side_profile_p">{{ $employe_data[0]->emp_code }}</p>
    </x-slot>
    <x-slot name="header_content">
        <div class="flex_div details_div_2">
            <p>{{ $employe_data[0]->emp_code }}</p>
            <p>{{ $employe_data[0]->phone }}</p>
            <p>{{ $employe_data[0]->designation_name }}</p>
        </div>
    </x-slot>
    <x-slot name="emp_name">
        @php
            $emp_name_arr = explode(' ', $employe_data[0]->employe_name);
            $emp_name = '';
            if (count($emp_name_arr) >= 2) {
                $emp_name = $emp_name_arr[0][0] . $emp_name_arr[1][0];
            } else {
                $emp_name = $emp_name_arr[0][0];
            }
        @endphp
        <p id="circle_name">{{ $emp_name }}</p>
    </x-slot>
    <x-slot name="basic">
        @include('layouts.basic', ['employe_data' => $employe_data])
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <p id="load" style="display: none">loading...</p>
                    <button id="btn">Send</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
