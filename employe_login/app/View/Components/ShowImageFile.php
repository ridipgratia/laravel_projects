<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ShowImageFile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void     */
    public $imageUrl;
    public function __construct($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.show-image-file');
    }
}
