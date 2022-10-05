<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "user_id",
        "code",
        "total_price",
        "phone_number",
        "email",
        "address",
        "status",
        "note",
    ];

    // 1 size has many many product
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(["quantity", "price", "size", "total_price"])
            ->withTimestamps();
    }
}
