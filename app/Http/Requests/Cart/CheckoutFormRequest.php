<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutFormRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email",
            "phone_number" => ["required", "regex:/^".self::createStrFirst3DigitsOfPhoneNumber()."[0-9]{7}$/i"] ,
            "address" => "required|min:20",
            // "required|regex:/(035|038)/i" ở đây k dùng theo kiểu dấu phân cách required|regex mà phải dùng mảng    
            // vì khi chứa  kí tự pipe ví dụ là | trong pattern (038|039) thì nó sẽ k dùng kiểu dấu phân cách | đc 
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Vui lòng nhập họ và tên",
            "email.required" => "Vui lòng nhập email",
            "email.email" => "Email không hợp lệ",
            "phone_number.required" => "Vui lòng nhập số điện thoại",
            "phone_number.regex" => "Số điện thoại không hợp lệ",
            "address.required" => "Vui lòng nhập địa chỉ",
            "address.min" => "Địa chỉ không hợp lệ",
        ];
    }

    private function createStrFirst3DigitsOfPhoneNumber()
    {
        $viettel = ["032", "033", "034", "035", "036", "037", "038", "039"];
        $mobiphone = ["070", "076", "077", "078", "079"];
        $vinaphone = ["081", "082", "083", "084", "085"];
        $vietnamobile = ["056", "058"];
        $gmobile = ["059"];

        $arrayFirst3Digits = array_merge($viettel, $mobiphone, $vinaphone, $vietnamobile, $gmobile);

        return "(" . implode("|", $arrayFirst3Digits) . ")";
    }
}
