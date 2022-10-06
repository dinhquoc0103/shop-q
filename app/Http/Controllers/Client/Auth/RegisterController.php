<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\UserService;
use App\Mail\EmailVerification;
use App\Helpers\Helper;


class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Show login page
    public function index()
    {
        return view("client.auth.register", [
            "title" => "Đăng ký tài khoản",
            "breadcrumb" => ["REGISTER"]
        ]);
    }

    // Create account or save user row
    public function register(RegisterFormRequest $request)
    {
        $data = $request->except(['confirm_password']);
        $data["password"] = Hash::make($data["password"]);
        $data["role"] = 0;
        $data["activation_code"] = Helper::randomString(8);
        
        $id = $this->userService->insertUserRowReturnId($data);
        
        $name = $data["name"];
        $activationCode = Helper::randomString();
       
        Mail::to($data["email"])->send(new EmailVerification($name, $id, $data["activation_code"]));

        return redirect()->route("email.verification.required");
    }


    public function emailVerificationRequired()
    {
        return view("client.auth.emailVerificationRequired");
    }


}
