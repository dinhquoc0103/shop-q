<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            "name" => "required|max:64",
            "email" => "required|email|unique:users",
            "password" => "required|min:8",
            "confirm_password" => "required|same:password"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Vui lòng nhập họ và tên",
            "name.max" => "Họ và tên tối đa 64 kí tự",
            "email.required" => "Vui lòng nhập email",
            "email.email" => "Email không hợp lệ",
            "email.unique" => "Email đã tồn tại",
            "password.required" => "Vui lòng nhập mật khẩu",
            "password.min" => "Mật khẩu phải tối thiểu 8 kí tự",
            "confirm_password.required" => "Vui lòng nhập xác nhận mật khẩu",
            "confirm_password.same" => "Xác nhận mật khẩu không khớp",
        ];
    }
}
