<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserSideInfo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userSideInfo;
    public function __construct($userSideInfo)
    {
        $this->userSideInfo = $userSideInfo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-side-info');
    }
}
