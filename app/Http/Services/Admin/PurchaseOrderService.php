<?php

namespace App\Http\Services\Admin;

use App\Models\PurchaseOrder;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PurchaseOrderService
{
    

    // Get all purchase order row
    public function getAllPurchaseOrders()
    {
        return PurchaseOrder::orderByDesc('id')->get();
    }

    // Get products in purchase order
    public function getProductsInPurchaseOrder($purchaseOrder)
    {
        $products = collect();
        foreach($purchaseOrder->products as $key => $product)
        {
            $product->quantity = $product->pivot->quantity;
            $product->total_price = $product->pivot->total_price;
            $products->push($product);
        }
        return $products;
    }

    // Get purchase order by id
    public function getPurchaseOrderById($id)
    {
        return PurchaseOrder::find($id);
    }

    // Update purchase order row
    public function updatePurchaseOrderRow($purchaseOrder, $data)
    {
        try{  
            $purchaseOrder->fill($data);
            $purchaseOrder->save();
        }
        catch(\Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    // Sum system revenue
    public function sumSystemRevenue()
    {
        return PurchaseOrder::where("status", 4)->sum("total_price");
    }

    // Count successful purchase order
    public function countSuccessfulPurchaseOrder()
    {
        return PurchaseOrder::where("status", 4)->count();
    }

    // Orders are being processed
    public function countProcessingPurchaseOrder()
    {
        return PurchaseOrder::where("status", '<=', 2)->count();
    }

    // Orders are canceled
    public function countCancelingPurchaseOrder()
    {
        return PurchaseOrder::where("status", 5)->count();
    }


    

    

    
}