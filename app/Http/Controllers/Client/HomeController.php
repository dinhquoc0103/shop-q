<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Client\SliderService;
use App\Http\Services\Client\ProductService;
use App\Http\Services\Client\MenuService;
use App\Http\Controllers\Client\ProductController;


class HomeController extends Controller
{   
    protected $sliderService;
    protected $productService;
    protected $menuService;

    public function __construct(SliderService $sliderService, ProductService $productService, MenuService $menuService)
    {
        $this->sliderService = $sliderService;
        $this->productService = $productService;
        $this->menuService = $menuService;
    }

    // protected function cart()
    // {
    //     return session("cart");
    // }
    // Show home page
    public function index()
    {   
        $sliders = $this->sliderService->getAllActivatedSliders();
        return view('client.home', [
            'title' => 'Trang chủ',
            'sliders' => $sliders,
            'products' => $this->productService->getNewProductList(),
            'pageName' => "home",
        ]);
    }

    // Load more products at home
    public function loadMoreProducts(Request $request)
    {
        $page = $request->input('page');
        $products = $this->productService->getNewProductList($page);
        
        $html = '<div class="row isotope-grid">';
        foreach($products as $product){
            $html .= view('client.products.product', ['product' => $product])->render();
        }
        $html .= '</div>';
        
        if(count($products) > 0){
            return response()->json([
                'message' => true,
                'html' => $html
            ]);
        }
      
        return response()->json([
            'message' => false,
        ]);
        
    }
}
