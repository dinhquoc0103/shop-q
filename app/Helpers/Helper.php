<?php
    namespace App\Helpers;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    class Helper
    {
        // public static function renderListMenu ($menus, $parent_id = 0, $char = '') {
        //     $html = '';
        //     foreach($menus as $key => $menu){
        //         if($menu->parent_id == $parent_id){
        //             $html .= '<tr class="odd" id="menu-'.$menu->id.'">
        //                         <td width="8%">'.$menu->id.'</td>
        //                         <td>'.$char . $menu->name.'</td>
        //                         <td width="5%" class="text-center">'.self::renderActive($menu->active).'</td>
        //                         <td width="18%">'.$menu->updated_at.'</td>
        //                         <td width="12%">
        //                             <a href="/admin/menus/edit/'.$menu->id.'" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
        //                             <btn onclick="removeRow('.$menu->id.', \'/admin/menus/destroy\', \'menu\')" class="btn btn-danger btn-sm btn-delete">
        //                                 <i class="far fa-trash-alt"></i>
        //                             </btn>
        //                         </td>
        //                     </tr>';                   
        //             unset($menus[$key]);
        //             $html .= self::renderListMenu($menus, $menu->id, "|--");
        //         }
               
               
        //     }
        //     return $html;
        // }

       /* ============================ Admin ============================ */ 

        // Render html for active column in admin
        public static function renderActive($active)
        {
            $html = '';        
            if($active == 1)
                $html = '<a href="#"><i class="fas fa-check-circle text-success"></i></a>';
            else
                $html = '<a href="#"><i class="fas fa-times-circle text-danger"></i></a>';

            return $html;
        }

        // Delete image saved when deleting product row in admin
        // Delete image in cloudinary
        public static function deleteFileUploaded($pathFile)
        {
            cloudinary()->destroy($pathFile);
        }
        // Delete image in storage folder 
        // public static function deleteFileUploaded($filePath)
        // {
        //     $filePath = str_replace("storage", "public", $filePath);
        //     Storage::delete($filePath);
        // }

        

        // Render menu on desktop header and mobile in client
        public static function renderHtmlMenus($menus, $device ,$parent_id = 0)
        {
            $arrayID = [];
            $html = '';
            $class = '';
            $arrowAngleRightHtml = '';

            
            switch ($device) {
                case 'desktop':
                    $class = 'sub-menu';
                    break;
                
                case 'mobile':
                    $class = 'sub-menu-m';
                    $arrowAngleRightHtml = '<span class="arrow-main-menu-m">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </span>';
                    break;
            }

            foreach($menus as $key => $menu){
                if(!in_array($menu->id, $arrayID))
                {
                    if($menu->parent_id == $parent_id){
                        $html .= ' <li class="">
                                    <a href="/collections/'. Str::slug($menu->name) .'">'.$menu->name.'</a>';
    
                        array_push($arrayID, $menu->id); 
                        if(self::isChild($menus, $menu->id)){
                            $html .= '<ul class="'.$class.'">';
                            $html .= self::renderHtmlMenus($menus, $device, $menu->id);
                            $html .= '</ul>';
                        }
                        $html .= $arrowAngleRightHtml . '</li>';
                    }
                    else
                    {
                        continue;
                    }
                }
            }
            return $html;
        }

        // Checking child menu
        public static function isChild($menus, $menu_id){
            foreach($menus as $key => $menu){
                if($menu->parent_id == $menu_id){
                    return true;
                }
            }
            return false;
        }


        /* ============================ Client ============================ */ 

        // Render html with view path and view data 
        public static function renderHtml($path, $data = [])
        {
            return view($path, $data)->render();
        }

        // Generate code from array of letters and array of numbers
        public static function randomString($length = 6)
        {
            $arrayChar = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
            $strChar = implode("", $arrayChar);

            // random chuỗi 
            $strChar = str_shuffle($strChar); 

            return substr($strChar, 0, $length);    
        }
        
    }


?>