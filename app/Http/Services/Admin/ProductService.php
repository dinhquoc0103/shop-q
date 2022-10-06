<?php

namespace App\Http\Services\Admin;

use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductSize;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProductService
{
    // Get menu list
    public function getMenuList()
    {
        return Menu::where([
            ['active', 1],
            ['parent_id', '<>', 0]
        ])->get();
    }

    
    /* 
    |   Không thể dùng eloquent để insert cho product_size table vì eloquent 
    |   sẽ tạo ra tên bảng là product_sizes != product_size mà product_sizes sẽ không
    |   dùng được relationship trong query 
    */
    // Insert product row
    public function insertProductRow($data)
    {  
        try
        {   
            $sizeArray = $data["size"];
            $quantityArray = $data["quantity"];
            unset($data["size"], $data["quantity"]);
            
            $productData = $data;
            $productId = Product::create($productData)->id;

            self::insertMultipleProductSizeRow($productId, $sizeArray, $quantityArray);  
        }
        catch(\Illuminate\Database\QueryException $error)
        {
            // \Illuminate\Database\QueryException có một số lỗi khi query 
            // chẳng hạn như khi insert mà lỡ thêm giá trị trùng với cột đã có là  unique constraint 
            // phải cần class \Illuminate\Database\QueryException thì mới catch được
            return false;
        }

        return true;
    }

    // Insert multiple ProductSize row
    private function insertMultipleProductSizeRow($productId, $sizeArray, $quantityArray)
    {   
        $productSizeData = [];
        foreach($sizeArray as $key => $size)
        {
            $productSizeData[$key] = [
                'product_id' => $productId,
                'size_id' => $size,
                'quantity' => $quantityArray[$key]
            ];
        }
        DB::table("product_size")->insert($productSizeData);
    }

    // Get all product row
    public function getAllProducts()
    {
        $productCollection = Product::orderByDesc('id')->get();

        foreach($productCollection as $product)
        {
            //Return product obj only contains name column
            $menuName = Menu::where('id', $product->menu_id)->first(['name']);
            // Set array for inventory column in view
            $inventory = [];
            foreach($product->sizes as $size)
            {
                $inventory[$size->name] = $size->pivot->quantity;
            }

            // Add new attribute to product obj
            $product->setAttribute('menu_name', $menuName->name);       
            $product->setAttribute('inventory', $inventory);
        }
        return $productCollection;
    }

    // Delete product row
    public function deleteProductRow($id)
    {
        $product = Product::where('id', $id)->first();
        $tempArray = explode("/", $product->thumb);
        $tempArray = explode(".", $tempArray[array_key_last($tempArray)]);
        $imgId = $tempArray[array_key_first($tempArray)];
        $pathFile = "products/" . $imgId;
        Helper::deleteFileUploaded($pathFile);

        return $product->delete();
    }

    // Delete multiple product row
    public function deleteMultipleRow($arrayOfID)
    {
        try{
            foreach($arrayOfID as $key => $id){
                self::deleteProductRow($id);
            }
        }
        catch(Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    // Update product row
    public function updateProductRow($product, $data)
    {   
        try{
            $productData = $data;
            unset($productData["size"], $productData["quantity"]);
            $product->fill($productData);
            $product->save();
            
            $quantityArray = $data["quantity"];
            foreach($product->sizes as $key => $size)
            {   
                DB::table("product_size")
                    ->where([
                        ["product_id", $product->id],
                        ["size_id", $size->id]
                    ])
                    ->update([
                        'quantity' => $quantityArray[$key]
                    ]);
            }
        }
        catch(Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    // Get new products
    public function getNewProducts($limit)
    {
        return Product::with("menu")
            ->where("active", 1)
            ->orderByDesc('id')
            ->offset(1)
            ->limit($limit)
            ->get();
    }

 

    
}