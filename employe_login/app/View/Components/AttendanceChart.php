<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AttendanceChart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $present;
    public function __construct($present)
    {
        $this->present = $present;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.attendance-chart');
    }
}
