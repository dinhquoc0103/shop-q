<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            "email" => "required|email",
            "password" => "required|min:8",
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Vui lòng nhập email",
            "email.email" => "Email không hợp lệ",
            "password.required" => "Vui lòng nhập mật khẩu",
            "password.min" => "Mật khẩu phải tối thiểu 8 kí tự",
        ];
    }
}
