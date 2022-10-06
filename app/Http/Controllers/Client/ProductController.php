<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Client\ProductService;
use App\Http\Services\Client\MenuService;
use App\Http\Services\SizeService;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{   
    protected $productService;
    protected $menuService;
    protected $sizeService;

    public function __construct(ProductService $productService, MenuService $menuService, SizeService $sizeService){
        $this->productService = $productService;
        $this->menuService = $menuService;
        $this->sizeService = $sizeService;
    }

    // Show product list
    public function listProduct(Request $request, $slug)
    {   

        $maxLevel = $this->menuService->maxLevel();
        $menu = $this->menuService->getMenuRowBySlug($slug);

        $level = $menu->level;
        $arrayID = [];
        if($level < $maxLevel)
        {
            $submenuList = $this->menuService->getSubmenuList($menu->id);
            foreach($submenuList as $key => $value)
            {
                array_push($arrayID, $value->id);
            }   
        }
        else
        {
            array_push($arrayID, $menu->id);
        }   
        
        $products = $this->productService->getProductList($arrayID, $request);

        if(!$request->ajax())
        {   
            return view('client.products.list', [
                'title' => 'Danh sách sản phẩm',
                'products' => $products,
                'sortByArray' => self::createSortByArray(),
                'priceFilterArray' => self::createPriceFilterArray(),
                'sortValue' => $request->input("sortBy"),
                'filterPrice' => $request->input("price"),
                'breadcrumb' => explode('+', self::createBreadcrumbString($menu)),
            ]);
        }
        else
        {     
            return response()->json([
                "htmlProductsPagination" => Helper::renderHtml("client.products.productPagination", ["products" => $products]),
            ]);
        }
        
    }

    // Product detail
    public function productDetail($slug)
    {   
        $product = $this->productService->getProductBySlug($slug);
        $breadcrumb = self::createBreadcrumbString($this->menuService->getMenuRowById($product->menu_id)) . "+" . strtoupper($product->name);
        // Total number of a product (1 product)
        $numProduct = $this->productService->countQuantityEachProduct($product->id);
        
        return view('client.products.detail', [
            'title' => $product->name,
            'product' => $product,
            'breadcrumb' => explode('+', $breadcrumb),
            'numProduct' => $numProduct
        ]);
    }

    // Searching product
    public function searchProduct(Request $request)
    {
        $keyword = $request->q;
        $products = $this->productService->getListProductByKeyword($keyword);
        
        return view("client.products.search", [
            'title' => "Tìm kiếm " . $keyword,
            "products" => $products 
        ]);
    }

    // Create breadcrumb string
    private function createBreadcrumbString($menu)
    {   
        $str = ''; 
        if($menu->level > 1)
        {   
            $parentMenu = $this->menuService->getParentMenu($menu->parent_id);
            $str .=  self::createBreadcrumbString($parentMenu) .'+';
        }
        $str .= $menu->name;
    
        return $str;
    }

    // Create static data for sort by array for select
    private function createSortByArray()
    {
        $array = [
            "price-asc" => "Giá tăng dần",
            "price-desc" => "Giá giảm dần",
            "name-asc" => "Tên A-Z",
            "name-desc" => "Tên Z-A",
        ];

        return $array;
    }

    // Create static data for price filter array for select
    private function createPriceFilterArray()
    {
        $array = [
            "0-100000" => "Giá dưới 100.000đ",
            "100000-200000" => "100.000đ - 200.000đ",
            "200000-300000" => "200.000đ - 300.000đ",
            "300000-500000" => "300.000đ - 500.000đ",
            "500000-max" => "Giá trên 500.000đ",
        ];

        return $array;
    }
}
