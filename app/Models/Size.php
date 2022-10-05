<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // 1 size belongs to many product
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(["quantity"])
            ->withTimestamps();
    }
}
