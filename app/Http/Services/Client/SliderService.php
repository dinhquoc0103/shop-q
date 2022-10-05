<?php

namespace App\Http\Services\Client;

use App\Models\Slider;
use App\Helpers\Helper;


class SliderService
{
    public function getAllActivatedSliders(){
        return Slider::where('active', 1)
                    ->orderBy('numerical_order', 'ASC')
                    ->get();
    }
}