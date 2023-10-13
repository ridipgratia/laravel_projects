<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\MyMethod\DelayEmpForm;
use Illuminate\Support\Facades\Auth;

class SearchByGpComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $district_name = DelayEmpForm::getDistrictName(Auth::user()->district);
        $block_name = DelayEmpForm::getBlockName(Auth::user()->block);
        $gp_names = DelayEmpForm::getGPName(Auth::user()->block);
        return view('components.search-by-gp-component', [
            'district_name' => $district_name,
            'block_name' => $block_name,
            'gp_names' => $gp_names
        ]);
    }
}
