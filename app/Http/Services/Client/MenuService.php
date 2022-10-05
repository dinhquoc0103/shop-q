<?php

namespace App\Http\Services\Client;

use App\Models\Menu;
use App\Helpers\Helper;
use Illuminate\Support\Str;


class MenuService
{
    public function getMenuRowBySlug($slug)
    {
        return Menu::where('slug', $slug)
                ->where('active', 1)
                ->firstOrFail();
    }

    public function getMenuRowById($id)
    {
        return Menu::where('id', $id)
                ->where('active', 1)
                ->firstOrFail();
    }

    // Get all activated menus (active = 1)
    public function getAllActivatedMenus()
    {
        return Menu::where("active", 1)->get();
    }

    // Find the max level of menu
    public function maxLevel()
    {
        return Menu::max("level");
    }

    // Get submenu list
    public function getSubmenuList($id)
    {
        return Menu::where([
            ["active", 1],
            ["parent_id", $id]
        ])->get();
    }

    // Get parent menu by parent_id of child
    public function getParentMenu($parent_id)
    {
        return Menu::where("id", $parent_id)->firstOrFail();
    }
}   