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
        $tempArray = explode("/", $slider->thumb);
        $tempArray = explode(".", $tempArray[array_key_last($tempArray)]);
        $imgId = $tempArray[array_key_first($tempArray)];
        $pathFile = "sliders/" . $imgId;
        Helper::deleteFileUploaded($pathFile);

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