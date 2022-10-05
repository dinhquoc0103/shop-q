<?php

namespace App\Http\Services;

use App\Models\Size;
use Illuminate\Support\Facades\Log;

class SizeService
{
    // Get all size row
    public function getAllSizes()
    {
        return Size::all();
    }
}