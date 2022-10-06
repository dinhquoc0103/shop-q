<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Client\CartService;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\Cart\CheckoutFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailOrderComplete;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

    private function setTotalProductsInCartSession($cart)
    {
        $totalProductsInCart = 0;
        foreach($cart as $item)
        {
            $totalProductsInCart += count($item["quantity"]);
        }
        Session::put("total_products_in_cart", $totalProductsInCart);
        Session::save();
    }

    private function setTotalPriceSession($cart)
    {
        $totalPrice = 0;
        foreach($cart as $item)
        {
            $totalPrice += array_sum($item["quantity"]) * $item["price"];
        }
        Session::put("total_price", $totalPrice);
        Session::save();
    }

    //Add product to cart
    public function addToCart(Request $request)
    {   
        $id = $request->input('id');
        $price = $request->input('price');
        $size = $request->input('size');
        $quantity = (int)$request->input('quantity');
        $cart = Session::get('cart');
        
        // Save to cart session
        if($cart == null){
            Session::put('cart', [
                $id => [
                    "quantity" => [$size => $quantity],
                    "price" => $price
                ]
            ]);
            Session::save();
        }
        else{
            if(!Arr::exists($cart, $id))
            {
                $cart[$id]["quantity"][$size] = $quantity;
                $cart[$id]["price"] = $price;
            }
            else
            {
                if(!Arr::exists($cart[$id]["quantity"], $size)){
                    $cart[$id]["quantity"][$size] = $quantity;
                }
                else{
                    $cart[$id]["quantity"][$size] += $quantity;
                }
            }
            Session::put('cart', $cart);
            Session::save();
        }

        $cart = Session::get('cart');
        self::setTotalProductsInCartSession($cart);
        self::setTotalPriceSession($cart);
        
        return response()->json([
            'productName' => $this->cartService->getProductName($id),
            'yourCartHtml' => Helper::renderHtml("client.carts.headerCartContent"),
            'totalProductInCart' => Session::get("total_products_in_cart")
        ]);
       
    }

    // Cart index
    public function index()
    {   
        $cart = Session::get('cart');
        $productsInCart = [];
        if($cart != null)
        {
            $arrayId = array_keys($cart);
            $productsInCart = $this->cartService->getProductsInCart($arrayId);
        } 
        $totalPrice = Session::get("total_price");

        return view('client.carts.index', [
            'title' => 'Giỏ Hàng',
            'breadcrumb' => ["Cart"],
            'cart' => $cart,
            'productsInCart' => $productsInCart,
            'totalPrice' => $totalPrice
        ]);
    }

    // Delete product in cart
    public function deleteProduct(Request $request)
    {   
        $cart = Session::get("cart");
        $id = $request->input("id");
        $size = $request->input("size"); 
        if(!Arr::exists($cart, $id) || !Arr::exists($cart[$id]["quantity"], $size))
        {
            return response()->json([
                "message" => false
            ]);
        }

        $result = $this->cartService->deleteProduct($id, $size);

        $cart = Session::get('cart');
        $arrayId = array_keys($cart);
        $productsInCart = $this->cartService->getProductsInCart($arrayId);
        self::setTotalProductsInCartSession($cart);
        self::setTotalPriceSession($cart);

        if($result)
        {
            return response()->json([
                "message" => $result,
                'emptyCartHtml' => Helper::renderHtml("client.carts.emptyCart"),
                'yourCartHtml' => Helper::renderHtml("client.carts.headerCartContent"),
                'totalPrice' => number_format(Session::get("total_price"), 0, '', '.'),
                'totalProductsInCart' => Session::get("total_products_in_cart"),   
            ]);
        }     
    }

    // Change product quantity in Cart Index
    public function changeProductQuantity(Request $request)
    {
        $cart = Session::get("cart");
        $id = $request->input("id");
        $size = $request->input("size");
        $quantity = $request->input('quantity');
        if(!Arr::exists($cart, $id) || !Arr::exists($cart[$id]["quantity"], $size))
        {
            return response()->json([
                "message" => false
            ]);
        }
        
        $cart[$id]["quantity"][$size] = $quantity;
        $intoMoney = $cart[$id]["quantity"][$size] * $cart[$id]["price"];
        self::setTotalPriceSession($cart);
        Session::put('cart', $cart);
        Session::save();
        return response()->json([
            "message" => true,
            "totalPrice" => number_format(Session::get("total_price"), 0, '', '.'),
            "intoMoney" => number_format($intoMoney, 0, '', '.'),
            'yourCartHtml' => Helper::renderHtml("client.carts.headerCartContent"),
        ]);
    }

    // Show checkout page
    public function checkout(Request $request)
    {
        return view("client.carts.checkout", [
            "title" => "Thanh Toán Đơn Hàng",
            "breadcrumb" => ["CHECKOUT"]
        ]);
    }

    // Save order information when the user places an order
    public function storePurchaseOrder(CheckoutFormRequest $request)
    {
        $purchaseOrderData = $request->except(["_token"]);
        $purchaseOrderData["user_id"] = Auth::check() ? Auth::id() : 0;
        $purchaseOrderData["code"] = Helper::randomString(18);
        $purchaseOrderData["total_price"] = Session::get("total_price");

        $result = $this->cartService->insertPurchaseOrderRow($purchaseOrderData);

        if($result)
        {   
            Mail::to($purchaseOrderData["email"])->send(new EmailOrderComplete($purchaseOrderData["code"]));
            session()->forget(["cart", "total_products_in_cart", "total_price"]);
            return redirect()->route("order.complete.page");
        }
        else
        {
            session()->flash("error", "Đặt hàng không thành công xin hãy thử lại!");
            return redirect()->route("checkout.page");
        }
    }

    public function orderComplete()
    {
        return view("client.carts.orderComplete", [
            "title" => "Đặt Hàng Thành Công"
        ]);
    }




















    // Add product to cart old has not size
    // public function addToCart(Request $request)
    // {
    //     $flag = false;
    //     $id = $request->input('id');
    //     $qty = (int)$request->input('qty');

    //     $cart = Session::get('cart');

    //     if($cart == null){
    //         Session::put('cart', [$id => $qty]);
    //         Session::save();
    //         $flag = true;
    //     }
    //     else{
    //         if(!Arr::exists($cart, $id)){
    //             $cart[$id] = $qty;
    //         }
    //         else{
    //             $cart[$id] += $qty;
    //         }
    //         Session::put('cart', $cart);
    //         Session::save();
    //         $flag = true;
    //     }

    //     $productName = $this->cartService->getProductName($id);
    //     $htmlProducts = view('client.carts.headerCartContent')->render();
    //     $totalProduct = count(Session::get('cart'));
        
    //     if($flag){
    //         return response()->json([
    //             'message' => true,
    //             'productName' => $productName,
    //             'htmlProducts' => $htmlProducts,
    //             'totalProduct' => $totalProduct
    //         ]);
    //     }

    //     return response()->json([
    //         'message' => false,
    //         'productName' => $productName
    //     ]);
       
    // }
}
