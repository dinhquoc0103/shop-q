<?php

namespace App\Http\Services\Client;

use App\Models\Product;
use App\Models\Menu;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ProductService
{
    // Get new product list for home
    public function getNewProductList($page = 0)
    {
        $limit = 8;
        $offset = $page * $limit;

        // Chỉ load 16 sản phẩm mới ở home (tức là 2 lần load là hết)
        if($offset > 16){
            return [];
        }

        $products = Product::select(['id', 'name', 'price', 'discount', 'active', 'thumb'])
                            ->orderByDesc('id')
                            ->offset($offset)
                            ->limit($limit)
                            ->get();        
        return $products;
    }

    // Get product list that includes pagination, filter
    public function getProductList($arrayID, $request)
    {
        $query = Product::whereIn("menu_id", $arrayID);
        
        // Sort by
        $sortBy = $request->input("sortBy");
        switch ($sortBy) {
            case "price-asc":
                $query->orderBy("price");
                break;
            case "price-desc":
                $query->orderBy("price", "DESC");
                break;
            case "name-asc":
                $query->orderBy("name");
                break;
            case "name-desc":
                $query->orderBy("name", "DESC");
                break;
        }

        // Filter price
        if($request->has("price"))
        {
            $filterPrice = $request->input("price");
            if($filterPrice !== "default")
            {
                $tempFilterPrice = explode('-', $filterPrice);
                if($tempFilterPrice[0] == 0)
                {
                    $query->where("price", '<', $tempFilterPrice[1]);
                }
                else if($tempFilterPrice[1] == "max")
                {
                    $query->where("price", '>', $tempFilterPrice[0]);
                }
                else
                {
                    $query->whereBetween("price", [$tempFilterPrice[0], $tempFilterPrice[1]]);
                }
            }     
        }

        return $query->paginate(8);            
    }

    // Count quantity of each product (including size M, L, XL, XXL)
    public function countQuantityEachProduct($id)
    {
        return DB::table("product_size")->where("product_id", $id)->sum("quantity");
    }

    // Get product by slug
    public function getProductBySlug($slug)
    {
        return Product::where('slug', $slug)->where('active', 1)
            ->firstOrFail();
    }

    // Get list of product by keyword 
    public function getListProductByKeyword($keyword)
    {
        return Product::where([
            ["active", 1],
            ["name", "LIKE", "%" . $keyword . "%"]
        ])->paginate(8)->withQueryString();
    }
}