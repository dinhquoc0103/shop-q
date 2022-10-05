<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\UserService;


class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        if(session('login') == true){
            return redirect()->route("admin");
        }
        
        return view("admin.auth.login", [
            'title' => 'Đăng Nhập Hệ Thống'
        ]);     
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input("remember");

        if(Auth::attempt(['email' => $email, 'password' => $password], $remember)){
            session()->flash('success', 'Đăng nhập thành công');
            session()->put('login', true);
            session()->put('role', 1);
            session()->put('id', $this->userService->getUserByEmail($email)->id);
            return redirect()->route("admin");
        }

        session()->flash('error', 'Email hoặc Password không đúng');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        session()->forget(["login"]);

        return redirect("/admin/users/login");
    }
}
