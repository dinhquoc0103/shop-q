<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:sliders,name,' . self::getSliderId($this->slider),
            'numerical_order' => 'required|gt:0|unique:sliders,numerical_order,' . self::getSliderId($this->slider),
            'url' => 'required|url',
            'thumb' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => "Vui lòng nhập tiêu đề",
            'name.max' => "Vui lòng nhập tiêu đề nhỏ hơn 255 kí tự",
            'name.unique' => "Tên slider đã tồn tại",
            'numerical_order.required' => "Vui lòng nhập thứ tự",
            'numerical_order.gt' => "Thứ tự không hợp lệ",
            'numerical_order.unique' => "Thứ tự đã có",
            'url.required' => "Vui lòng nhập url",
            'url.url' => "Url không hợp lệ",
            'thumb.required' => "Vui lòng thêm hình ảnh"

        ];
    }

    private function getSliderId($slider)
    {
        if($slider != null)
        {
            return $slider->id;
        }
        return '';
    }

}
