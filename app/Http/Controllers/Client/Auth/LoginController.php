<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login page 
    public function index()
    {
        session()->forget("login");
        return view("client.auth.login", [
            "title" => "Đăng nhập",
            "breadcrumb" => ["LOGIN"]
        ]);
    }

    // Login to website
    public function login(LoginFormRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Checking email and password and active
        if(Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1]))
        {
            $request->session()->put("role", Auth::user()->role);
            $request->session()->put("id", Auth::id());
            if(Auth::user()->role == 1)
            {
                $request->session()->put("login", true);
            }
            
            return redirect("/");
        }
        
        $request->session()->flash("error", "Email hoặc mật khẩu không đúng");
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget(["id", "role"]);
        if($request->session()->has("login"))
        {
            $request->session()->forget(["login"]);
        }
        return redirect("/");
    }
}
