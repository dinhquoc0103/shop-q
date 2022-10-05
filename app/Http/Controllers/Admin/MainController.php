<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\PurchaseOrderService;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\UserService;

class MainController extends Controller
{
    protected $purchaseOrderService;
    protected $productService;

    public function __construct(PurchaseOrderService $purchaseOrderService, ProductService $productService, UserService $userService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->productService = $productService;
        $this->userService = $userService;
    }

    public function index()
    {
        $systemRevenue = $this->purchaseOrderService->sumSystemRevenue();
        $successfulPurchaseOrder = $this->purchaseOrderService->countSuccessfulPurchaseOrder();
        $processingPurchaseOrder = $this->purchaseOrderService->countProcessingPurchaseOrder();
        $cancelingPurchaseOrder = $this->purchaseOrderService->countCancelingPurchaseOrder();
        $newProducts = $this->productService->getNewProducts(10);
        $newUsers = $this->userService->getNewUser(10);
        
        return view("admin.dashboard", [
            'title' => 'Trang Chủ Quản Trị Admin',
            'breadcrumb' => 'Bảng Điều Khiển',
            'systemRevenue' => $systemRevenue,
            'successfulPurchaseOrder' => $successfulPurchaseOrder,
            'processingPurchaseOrder' => $processingPurchaseOrder,
            'cancelingPurchaseOrder' => $cancelingPurchaseOrder,
            'newProducts' => $newProducts,
            'newUsers' => $newUsers,
        ]);
    }
}
