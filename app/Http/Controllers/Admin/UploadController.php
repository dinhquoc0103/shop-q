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
       
    // Upload images to cloudinary 
    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->uploadService->store($data);

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


    // Upload images to storage folder in laravel project
    // public function store(Request $request)
    // {
    //     $result = $this->uploadService->store($request);

    //     if($result == false){
    //         return \response()->json([
    //             'message' => false, 
    //         ]); 
    //     }

    //     return \response()->json([
    //         'message' => true, 
    //         'path' => $result
    //     ]);
    // }
}
