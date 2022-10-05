<?php

namespace App\Http\Services\Client;

use App\Models\Product;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\DB;


class CartService
{
    // Get product name
    public function getProductName($id)
    {
        return Product::where('id', $id)->firstOrFail(["name"])->name;
    }

    // Get product for cart
    public function getProductsInCart($arrayId)
    {
        return Product::where('active', 1)->whereIn('id', $arrayId)->get();
    }
    
    // Delete product in cart 
    public function deleteProduct($id, $size)
    {      
        try{
            $cart = Session::get('cart');
            unset($cart[$id]["quantity"][$size]);
            if(count($cart[$id]["quantity"]) == 0)
            {
                unset($cart[$id]);
            }
            Session::put('cart', $cart);
            Session::save();
        }
        catch(Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    public function insertPurchaseOrderRow($purchaseOrderData)
    {
        try
        {
            $purchaseOrderId = PurchaseOrder::create($purchaseOrderData)->id;

            $cart = Session::get("cart");
            $productPurchaseOrderData = [];
            foreach($cart as $key => $value)
            {
                foreach($value["quantity"] as $size => $quantity)
                {
                    array_push($productPurchaseOrderData, [
                        "product_id" => $key, 
                        "purchase_order_id" => $purchaseOrderId, 
                        "size" => $size, 
                        "quantity" => $quantity, 
                        "price" => $value["price"], 
                        "total_price" => $quantity*$value["price"]
                    ]);
                }
            }

            DB::table("product_purchase_order")->insert($productPurchaseOrderData);
        }
        catch(QueryException $error)
        {
            dd($error);
            return false;
        }
        return true;
    }
}   