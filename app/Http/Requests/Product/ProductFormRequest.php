<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProductFormRequest extends FormRequest
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
            // Bằng một cách nào đó mà $this->product sẽ ra product đang update
            // hoặc 'name' => ['required', 'max:255', Rule::unique('products')->ignore($this->product->id)],
            'name' => 'required|max:255|unique:products,name,'.self::getProductId($this->product),
            'price' => 'required|gt:-1',
            'discount' => 'required|digits_between:0,100',
            'thumb' => 'required',
            'menu_id' => 'required',
            'quantity.*' => 'required|gt:-1',
        ];
    }

    public function messages(){
        return [
            'name.required' => "Vui lòng nhập tên sản phẩm",
            'name.max' => "Vui lòng nhập tên sản phẩm nhỏ hơn 255 kí tự",
            'name.unique' => "Tên sản phẩm đã tồn tại",
            'price.required' => "Vui lòng nhập giá sản phẩm",
            'price.gt' => "Giá sản phẩm không hợp lệ",
            'discount.required' => "Vui lòng nhập phần trăm giảm giá",
            'discount.digits_between' => "Phần trăm giảm giá phải là từ 0 đến 100",
            'thumb.required' => "Vui lòng thêm hình ảnh",
            'menu_id.required' => "Vui lòng chọn danh mục",
            'quantity.*.required' => 'Vui lòng nhập số lượng sản phẩm',    
            'quantity.*.gt' => 'Số lượng sản phẩm không hợp lệ',    

        ];
    }

    // Get product Id
    private function getProductId($product)
    {
        if($product != null)
        {
            return $product->id;
        }
        return '';
    }
}
