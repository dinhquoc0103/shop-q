<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateInfoFormRequest extends FormRequest
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
            "name" => "required|min:2",
            "email" => "required|email|unique:users,email," . self::getUserId(),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Vui lòng nhập họ và tên",
            'name.min' => "Họ và tên phải từ 2 kí tự trở lên",
            'email.required' => "Vui lòng nhập email",
            'email.email' => "Email không hợp lệ",
            'email.unique' => "Email đã tồn tại",
        ];
    }

    private function getUserId()
    {
        return Auth::check() ? Auth::id() : null;
    }
}
