<?php

namespace App\Http\Services\Client;

use App\Models\PurchaseOrder;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PurchaseOrderService
{
    // Get all purchase order row
    public function getAllPurchaseOrdersByUserId($user_id)
    {
        return PurchaseOrder::where("user_id", $user_id)->orderByDesc('id')->get();
    }    

    // Get products in purchase order
    public function getProductsInPurchaseOrder($purchaseOrder)
    {
        $products = collect();
        foreach($purchaseOrder->products as $key => $product)
        {
            $product->quantity = $product->pivot->quantity;
            $product->size = $product->pivot->size;
            $product->total_price = $product->pivot->total_price;
            $products->push($product);
        }
        return $products;
    }
}