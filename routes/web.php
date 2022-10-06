<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Auth\LoginController AS AdminLoginController;
use App\Http\Controllers\Admin\MainController AS AdminMainController;
use App\Http\Controllers\Admin\MenuController AS AdminMenuController;
use App\Http\Controllers\Admin\ProductController AS AdminProductController;
use App\Http\Controllers\Admin\UploadController AS AdminUploadController;
use App\Http\Controllers\Admin\SliderController AS AdminSliderController;
use App\Http\Controllers\Admin\PurchaseOrderController AS AdminPurchaseOrderController;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\Auth\RegisterController;
use App\Http\Controllers\Client\Auth\LoginController;

use App\Http\Controllers\MailController;

/* ================ Admin ================ */
Route::get("admin/users/login", [AdminLoginController::class, "index"])
    ->name("admin.login.page");
Route::post('admin/users/login/store', [AdminLoginController::class, "login"]);
Route::get('admin/users/logout', [AdminLoginController::class, "logout"]);

Route::middleware(['auth'])->group(function () { 
    Route::prefix('admin')->group(function () {   
        # Index
        Route::get("/", [AdminMainController::class, "index"])
            ->name("admin");
        Route::get("index", [AdminMainController::class, "index"]);
        Route::get("home", [AdminMainController::class, "index"]);

        # Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [AdminMenuController::class, 'addMenu'])
                ->name('addMenu');
            Route::post('add', [AdminMenuController::class, 'storeMenu']);

            Route::get('edit/{menu}', [AdminMenuController::class, 'editMenu']);
            Route::post('edit/{menu}', [AdminMenuController::class, 'updateMenu']);

            Route::get('{level}/list/{id?}', [AdminMenuController::class, 'listMenu']);
            
            Route::get('getMenuList/{level}/{parent_id?}', [AdminMenuController::class, 'getMenuList']);
            Route::post("getParentMenuList", [AdminMenuController::class, 'getParentMenuList']);
            
            Route::delete('delete', [AdminMenuController::class, 'deleteMenu']);
            Route::post('deleteMultiple', [AdminMenuController::class, 'deleteMultipleMenus']);
        });

        # Product
        Route::prefix('products')->group(function (){
            Route::get('add', [AdminProductController::class, 'addProduct'])
                ->name('addProduct');
            Route::post('add', [AdminProductController::class, 'storeProduct']);

            Route::get('edit/{product}', [AdminProductController::class, 'editProduct']);
            Route::post('edit/{product}', [AdminProductController::class, 'updateProduct']);

            Route::get('list', [AdminProductController::class, 'listProduct'])
                ->name('listProduct');

            Route::delete('delete', [AdminProductController::class, 'deleteProduct']);
            Route::post('deleteMultiple', [AdminProductController::class, 'deleteMultipleProducts']);

            Route::get('getProductList', [AdminProductController::class, 'getProductList']);

        });

        # Upload
        Route::post('upload/store', [AdminUploadController::class, 'store']);

        # Slider
        Route::prefix('sliders')->group(function (){
            Route::get('add', [AdminSliderController::class, 'addSlider'])
                ->name('addSlider');
            Route::post('add', [AdminSliderController::class, 'storeSlider']);

            Route::get('list', [AdminSliderController::class, 'listSlider'])
                ->name('listSlider');
            
            Route::get('edit/{slider}', [AdminSliderController::class, 'editSlider']);
            Route::post('edit/{slider}', [AdminSliderController::class, 'updateSlider']);

            Route::delete('delete', [AdminSliderController::class, 'deleteSlider']);
            Route::post('deleteMultiple', [AdminSliderController::class, 'deleteMultipleSliders']);

            Route::get('getSliderList', [AdminSliderController::class, 'getSliderList']);

        });

        # Purchase Order
        Route::prefix('purchaseOrders')->group(function (){
            Route::get("list", [AdminPurchaseOrderController::class, "listPurchaseOrder"])
                ->name("admin.list.purchase.order");

            Route::get('getPurchaseOrderList', [AdminPurchaseOrderController::class, 'getPurchaseOrderList']);

            Route::get('detail/{purchaseOrder}', [AdminPurchaseOrderController::class, 'purchaseOrderDetail']);
            Route::post('changePurchaseOrderStatus', [AdminPurchaseOrderController::class, 'changePurchaseOrderStatus']);
            
        });
    });  
});

/* ================ Client ================ */
# Home
Route::get('/', [HomeController::class, 'index']);
Route::get('index', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);

# Load more new product at Home
Route::post('home/loadMoreProducts', [HomeController::class, 'loadMoreProducts']);

# List product
Route::get('collections/{slug}', [ProductController::class, 'listProduct']);
Route::get('products/{slug}', [ProductController::class, 'productDetail']);
Route::get('search', [ProductController::class, 'searchProduct'])->name("search.product");

# Cart
Route::get('cart', [CartController::class, 'index'])->name("cart.index");
Route::post('cart/addToCart', [CartController::class, 'addToCart']);
Route::post('cart/delete', [CartController::class, 'deleteProduct']);
Route::post('cart/changeProductQuantity', [CartController::class, 'changeProductQuantity']);
Route::get('checkout', [CartController::class, 'checkout'])->name("checkout.page");
Route::post('checkout', [CartController::class, 'storePurchaseOrder'])->name("checkout");
Route::get('orderComplete', [CartController::class, 'orderComplete'])->name("order.complete.page");

# Auth
Route::middleware(['auth'])->group(function () {
    # Logout
    Route::get('account/logout', [LoginController::class, 'logout'])->name('logout');

    # User 
    Route::get('account', [UserController::class, 'index'])->name('user.index');
    Route::get('account/updateInfo', [UserController::class, 'editInfoUser'])->name('user.update.info');
    Route::post('account/updateInfo', [UserController::class, 'updateInfoUser']);
});

Route::middleware(['guest'])->group(function () {
    # Register
    Route::get('account/register', [RegisterController::class, 'index'])->name('register.page');
    Route::post('account/register', [RegisterController::class, 'register']);
    Route::get('emailVerificationRequired', [RegisterController::class, 'emailVerificationRequired'])->name('email.verification.required');
    
    #Login
    Route::get('account/login', [LoginController::class, 'index'])->name('login.page');
    Route::post('account/login', [LoginController::class, 'login']);

    Route::get('email/verify/{id}/{activationCode}', [MailController::class, 'verify']);
});

use App\Http\Controllers\TestController;

Route::get("test", [TestController::class, 'index']);
Route::post("test", [TestController::class, 'post']);

