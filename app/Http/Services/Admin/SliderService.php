<?php

namespace App\Http\Services\Admin;
use App\Models\Slider;
use Illuminate\Support\Str;
use App\Helpers\Helper;


class SliderService
{
    public function insert($data)
    {
        try
        {
            Slider::create($data);
        }
        catch(Exception $error)
        {
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    // Get all slider row
    public function getAllSliders()
    {
        return Slider::orderByDesc('id')->get();
    }

    // Update slider row
    public function updateSliderRow($data, $slider)
    {
        try{
            $slider->fill($data);
            $slider->save();
        }
        catch(Exception $error){
            Log::info($error->getMessage());
            return false;
        }
        
        return true;
    }

    // Delete slider row
    public function deleteSliderRow($id)
    {
        $slider = Slider::where('id', $id)->first();

        Helper::deleteFileUploaded($slider->thumb);

        return $slider->delete();
    }

    // Delete multiple slider row
    public function deleteMultipleRow($arrayId)
    {
        try{
            Slider::destroy($arrayId);
        }
        catch(Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }
}