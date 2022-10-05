<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "purchase_order_id",
        "quantity",
        "price",
        "total_price",
    ];
}
