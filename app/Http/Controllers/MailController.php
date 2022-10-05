<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;

class MailController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function verify($id, $activationCode)
    {
        $user = $this->userService->getUserById($id);
        if($user !== null)
        {   
            if($activationCode === $user->activation_code)
            {
                $data["activation_code"] = 1;
                $data["active"] = 1;
                $result = $this->userService->updateUserRow($user, $data);
                
                if($result)
                {
                    session()->flash("verify_success", "Xác thực email thành công. Đăng nhập để mua sắm thôi nào!");
                    return redirect()->route("login.page");
                }
            }  
        }
    }
}
