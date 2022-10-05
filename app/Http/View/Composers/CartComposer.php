<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Http\Services\Client\CartService;

class CartComposer
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function compose(View $view)
    {   
        $cart = Session::get('cart');
        $productsInCart = [];
        if($cart != null)
        {
            $arrayId = array_keys($cart);
            $productsInCart = $this->cartService->getProductsInCart($arrayId);
        } 
        $totalPrice = Session::has("total_price") ? Session::get("total_price") : 0;
        $totalProductsInCart = Session::has("total_products_in_cart") ? Session::get("total_products_in_cart") : 0;

        $view->with([
            'cart' => $cart,
            'productsInCart' => $productsInCart,
            'totalPrice' => $totalPrice,
            'totalProductsInCart' => $totalProductsInCart,
        ]);
    }
}

?>