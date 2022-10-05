<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Client\PurchaseOrderService;
use App\Http\Services\UserService;
use App\Http\Requests\User\UpdateInfoFormRequest;

class UserController extends Controller
{
    protected $userService;
    protected $purchaseOrderService;

    public function __construct(UserService $userService, PurchaseOrderService $purchaseOrderService)
    {
        $this->userService = $userService;
        $this->purchaseOrderService = $purchaseOrderService;
    }

    public function index()
    {
        $user = Auth::check() ? Auth::user() : null;
        $purchaseOrders = $this->purchaseOrderService->getAllPurchaseOrdersByUserId($user->id);

        return view("client.users.index", [
            "title" => "Tài khoản",
            "breadcrumb" => ["ACCOUNT"],
            "user" => $user,
            "purchaseOrders" => $purchaseOrders,
            "arrayStatus" => [
                "Chờ xác nhận",
                "Đã xác nhận",
                "Đang chuẩn bị hàng",
                "Đang vận chuyển",
                "Giao hàng thành công",
                "Hủy đơn",
            ]
        ]);
    }

    public function editInfoUser()
    {
        return view("client.users.updateInfo", [
            "title" => "Cập nhật thông tin tài khoản",
            "breadcrumb" => ["UPDATE INFO"],
            "user" => Auth::check() ? Auth::user() : null
        ]);
    }

    public function updateInfoUser(UpdateInfoFormRequest $request)
    {
        $user = Auth::check() ? Auth::user() : null;
        $data = $request->all();
        $result = $this->userService->updateUserRow($user, $data);

        if($result)
        {
            return redirect()->route("user.index");
        }
    }
}
