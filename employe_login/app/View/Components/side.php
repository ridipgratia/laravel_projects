<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class side extends Component
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

    public function render()
    {
        $emp_code = DB::table('all_employe_details')->where('id', Auth::user()->e_id)->select('emp_code')->get();
        return view('components.side', ['emp_code' => $emp_code[0]->emp_code]);
    }
}
