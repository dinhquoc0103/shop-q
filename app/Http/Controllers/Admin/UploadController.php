<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UploadService;

class UploadController extends Controller
{   
    protected $uploadService;

    public function __construct(UploadService $uploadService){
        $this->uploadService = $uploadService;
    }
    
    public function store(Request $request){

        $result = $this->uploadService->store($request);

        if($result == false){
            return \response()->json([
                'message' => false, 
            ]); 
        }

        return \response()->json([
            'message' => true, 
            'path' => $result
        ]);
    }
}
