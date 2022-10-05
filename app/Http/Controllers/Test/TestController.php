<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;



class TestController extends Controller
{
    public function index(Request $request){
        Session::forget('cart');
        Session::save();
        $sliders = Slider::where('active', 1)->orderBy('order', 'desc')->orderBy('id', 'asc')->paginate(2);
        $s = Slider::where('active', 1)->first();
        dd($s);
        return view('test.test', [
            'sliders' => $sliders,
            
        ]);
    }

    public function index2(){

        // $sliders = Slider::where('active', 1)->paginate(3);
        // return view('test.test', [
        //     // 'sliders' => $sliders,
        //     // 'result' => "phần đầu của trang"
        // ]);
    }

    public function test(Request $request){
        
        return response()->json([
            'message' => 'thành công',
        ]);
    }

}
