<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestFormRequest;

class TestController extends Controller
{
    public function index()
    {
        return \view("index");
    }

    public function post(TestFormRequest $request)
    {   dd($request->all());
        return \redirect()->route("cart.index");
    }
}
