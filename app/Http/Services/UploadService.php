<?php

namespace App\Http\Services;


class UploadService
{
    public function store($request){
        try{
            if($request->hasFile('file')){
                $fileObj = $request->file('file');
                $archiveFolderName = $request->input('archive-folder-name');
    
                $filename =  date('m_d_Y') . '_' . $fileObj->getClientOriginalName();
                
                $pathImg = 'images/' . $archiveFolderName;
                $fileObj->storeAs(
                    'public/images/' . $archiveFolderName,
                     $filename        
                ); 
                
                return '/storage/' . $pathImg . '/' . $filename;
            }
        }
        catch(Exception $error){
            return false;
        }
        
    }
}