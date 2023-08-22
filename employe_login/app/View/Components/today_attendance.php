<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class today_attendance extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public $name;
    public function render()
    {
        date_default_timezone_set('Asia/Kolkata');
        $today = date("Y-m-d");
        $name = "Ok";
        return view('components.today_attendance', ['name' => $name]);
    }
}
