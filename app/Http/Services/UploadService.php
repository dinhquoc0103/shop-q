<?php

namespace App\Http\Services;


class UploadService
{
    
    // Upload image to cloudinary
    public function store($data)
    {
        try
        {
            $uploadedFileUrl = cloudinary()->upload(
                $data["file"]->getRealPath(), ["folder" => $data["archive-folder-name"]
            ])->getSecurePath();
            
            return $uploadedFileUrl;
        }
        catch(Exception $error)
        {
            return false;
        }
        
    }

    // Upload local to storage folder in laravel project 
    // public function store($request){
    //     try{
    //         if($request->hasFile('file')){
    //             $fileObj = $request->file('file');
    //             $archiveFolderName = $request->input('archive-folder-name');
    
    //             $filename =  date('m_d_Y') . '_' . $fileObj->getClientOriginalName();
                
    //             $pathImg = 'images/' . $archiveFolderName;
    //             $fileObj->storeAs(
    //                 'public/images/' . $archiveFolderName,
    //                  $filename        
    //             ); 
                
    //             return '/storage/' . $pathImg . '/' . $filename;
    //         }
    //     }
    //     catch(Exception $error){
    //         return false;
    //     }
        
    // }
}