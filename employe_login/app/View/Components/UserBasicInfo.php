<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserBasicInfo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user_basic_info;
    public function __construct($userInfo)
    {
        $this->user_basic_info = $userInfo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-basic-info');
    }
}
