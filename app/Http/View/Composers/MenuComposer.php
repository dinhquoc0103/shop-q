<?php

namespace App\Http\View\Composers;

use App\Models\Slider;
use App\Models\Menu;
use App\Http\Services\Client\MenuService;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class MenuComposer
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    // Get all menus have active = 1
    public function getAllActivatedMenus()
    {
        return $this->menuService->getAllActivatedMenus();
    }

    public function compose(View $view)
    {   
        $menus = self::getAllActivatedMenus();

        // Share to header view 
        $view->with([
            'menus' => $menus,
        ]);
    }
}

?>