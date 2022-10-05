<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuFormRequest extends FormRequest
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
            "name" => "required|unique:menus,name," . self::getMenuId($this->menu),
            "level" => "not_in:0",
            "parent_id" => "not_in:0",
        ];
    }

    public function messages(){
        return [
            "name.required" => "Vui lòng nhập tên danh mục",
            "name.unique" => "Tên danh mục đã tồn tại",
            "level.not_in" => "Chưa chọn cấp menu",
            "parent_id.not_in" => "Chưa chọn danh mục cha",
        ];
    }

    // Get menu id
    private function getMenuId($menu)
    {
        if($menu != null)
        {
            return $menu->id;
        }
        return '';
    }

}
