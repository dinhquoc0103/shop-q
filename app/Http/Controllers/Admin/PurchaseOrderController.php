<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\PurchaseOrderService;
use App\Models\PurchaseOrder;
use Yajra\Datatables\Datatables;    

class PurchaseOrderController extends Controller
{
    protected $purchaseOrderService;
    
    public function __construct(PurchaseOrderService $purchaseOrderService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
    }

    // Show page list purchase order
    public function listPurchaseOrder()
    {
        $purchaseOrders = $this->purchaseOrderService->getAllPurchaseOrders();
        return view("admin.purchaseOrders.list", [
            "title" => "Danh sách đơn đặt hàng",
            "breadcrumb" => "Danh Sách Đơn Đặt Hàng"
        ]);
    }

    // Get purchase order return for ajax datatables
    public function getPurchaseOrderList()
    {
        $purchaseOrders = $this->purchaseOrderService->getAllPurchaseOrders();
        return DataTables::of($purchaseOrders)->make(true);
    }

    // Show purchase order detail
    public function purchaseOrderDetail(PurchaseOrder $purchaseOrder)
    {
        $productsInPurchaseOrder = $this->purchaseOrderService->getProductsInPurchaseOrder($purchaseOrder);
        return view("admin.purchaseOrders.detail", [
            "title" => "Chi tiết đơn đặt hàng",
            "breadcrumb" => "Chi Tiết Đơn Đặt Hàng",
            "purchaseOrder" => $purchaseOrder,
            "productsInPurchaseOrder" => $productsInPurchaseOrder
        ]);
    }

    // Change purchase order status
    public function changePurchaseOrderStatus(Request $request)
    {
        $purchaseOrder = $this->purchaseOrderService->getPurchaseOrderById($request->id);
        $data = $request->all();
        $result = $this->purchaseOrderService->updatePurchaseOrderRow($purchaseOrder, $data);

        return response()->json([
            "message" => $result
        ]);
    }
}
