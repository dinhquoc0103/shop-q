<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Size;
use App\Models\PurchaseOrder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'active',
        'thumb',
        'description',
        'content',
        'menu_id',
        'slug'
    ];

    // 1 product belongs to a menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    // 1 product belongs to many size
    public function sizes()
    {   
        /* Với mỗi cột không phải khóa ngoại nếu tham chiều từ bên nào ví dụ đây là từ size trỏ ra thì phải thêm vô 
        sau relationship mới truy vấn được bằng relationship*/
        return $this->belongsToMany(Size::class)
            ->withPivot(["quantity"])
            ->withTimestamps();
    }

    // 1 product belongs to many purchase order
    public function purchase_orders()
    {
        return $this->belongsToMany(PurchaseOrder::class)
            ->withPivot(["quantity", "price", "size", "total_price"])
            ->withTimestamps();
    }
}

