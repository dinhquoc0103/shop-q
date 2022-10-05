<?php

namespace App\Http\Services\Admin;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class MenuService
{
    // Insert menu row
    public function insertMenuRow($data)
    {    
        try{
            Menu::create($data);
        }
        catch(\Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    // Returns a list of menu by level using two parameters "level" and "parent_id"
    public function getAllMenus($level, $parent_id)
    {   
        return Menu::where([
            ["level", $level],
            ["parent_id", $parent_id]
        ])->orderByDesc("id")->get();
    }

    // Return list of menu by parent level
    public function getParentMenuList($parentMenuLevel)
    {
        return Menu::where("level", $parentMenuLevel)->get();
    }

    // Delete menu row
    public function deleteMenuRow($id)
    {
        try
        {
            $menu = Menu::where('id', $id)->first();
            $submenuList = Menu::where('parent_id', $menu->id)->get('id');
            $arrayId = [];
            if($submenuList->isNotEmpty())
            {
                foreach($submenuList as $submenu)
                {
                    array_push($arrayId, $submenu->id);
                    $productsInCategory = Product::where("menu_id", $submenu->id)->get();
                    if(count($productsInCategory) > 0)
                    {
                        return false;
                    }
                }
                Menu::destroy($arrayId);
            }
            $menu->delete();
        }
        catch(\Illuminate\Database\QueryException $error)
        {
            return false;
        }
        return true;
    }

    // Delete multiple menu row
    public function deleteMultipleRow($arrayId)
    {
        try{
            Menu::destroy($arrayId);
        }
        catch(Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }

    // Update product row
    public function updateMenuRow($menu, $data)
    {
        try{
            $menu->fill($data);
            $menu->save();
        }
        catch(\Exception $error){
            Log::info($error->getMessage());
            return false;
        }

        return true;
    }
}