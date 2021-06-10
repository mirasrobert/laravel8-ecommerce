<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserProfile extends Component
{

    public $selectedProvince;
    public $selectedCity;
    public $selectedBrgy;
    
    public function __construct($selectedProvince, $selectedCity, $selectedBrgy)
    {
        $this->selectedProvince = $selectedProvince;
        $this->selectedCity = $selectedCity;
        $this->selectedBrgy = $selectedBrgy;
    }


    public function render()
    {
        return view('components.user-profile');
    }
}
