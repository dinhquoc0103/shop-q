<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Menu\MenuFormRequest;
use App\Http\Services\Admin\MenuService;
use App\Models\Menu;
use Yajra\Datatables\Datatables;


class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }

    // Show page to add menu
    public function addMenu(){
        return view('admin.menus.add', [
            'title' => 'Thêm Danh Mục',
            'breadcrumb' => 'Thêm Danh Mục',
            'levelArray' => [1, 2]
        ]);
    }

    // Save menu when adding
    public function storeMenu(MenuFormRequest $request)
    {   
        $data = $request->except(['_token']);
        $data["slug"] = Str::slug($data["name"]);
        $data["level"] == 1 ? $data["parent_id"] = 0 : '';

        $result = $this->menuService->insertMenuRow($data);

        if(!$result){
            session()->flash("error", "Danh mục đã tồn tại");
        }
        else{
            session()->flash("success", "Thêm mới danh mục thành công");
        }

        return redirect()->back();  
    }

    // Get parent menu list
    public function getParentMenuList(Request $request)
    {
        $parentMenuLevel = $request->input('parentLevel');    
        $parentMenuList = $this->menuService->getParentMenuList($parentMenuLevel);

        session(["parent_menu_list" => $parentMenuList]);

        return response()->json([
            "parentMenuList" => $parentMenuList
        ]);
    }

    // Show menu list by level
    public function listMenu($level, $id = 0)
    {   
        return view("admin.menus.list", [
            "title" => "Danh sách danh mục mới nhất",
            "breadcrumb" => "Danh sách danh mục cấp " . $level,
            "level" => $level,
        ]);
    }

    // Get menu list by level and parent_id to add to datatable's ajax manager
    public function getMenuList($level, $parent_id = 0)
    {
        $menus = $this->menuService->getAllMenus($level, $parent_id);
        
        return DataTables::of($menus)->make(true);
    }

    

    // Delete menu
    public function deleteMenu(Request $request){
        $id = $request->input('id');
        $result = $this->menuService->deleteMenuRow($id);

        return response()->json([
            "message" => $result,
        ]);
    }

    // Delete multiple menu
    public function deleteMultipleMenus(Request $request)
    {
        $arrayId = $request->input("array_of_id");
        $result = $this->menuService->deleteMultipleRow($arrayId);

        return response()->json([
            "message" => $result,
        ]);
    }

    // Show page to edit menu
    public function editMenu(Menu $menu)
    {
        $parentMenuList = $this->menuService->getParentMenuList($menu->level - 1);
        $levelArray = [1, 2];

        return view("admin.menus.edit", [
            "title" => "Chỉnh sửa danh mục" . $menu->name,
            "breadcrumb" => "Chỉnh sửa danh mục",
            "menu" => $menu,
            "parentMenuList" => $parentMenuList,
            'levelArray' => $levelArray
        ]);
    }

    // Update menu when editing
    public function updateMenu(Menu $menu, MenuFormRequest $request)
    {       
        $data = $request->except(['_token']);
        $data["slug"] = Str::slug($data["name"]);
        !$request->has("level") ? $data['level'] = 1 : '';
        $data["level"] == 1 ? $data["parent_id"] = 0 : '';
        
        $result = $this->menuService->updateMenuRow($menu, $data);

        if(!$result){
            session()->flash("error", "Cập nhật danh mục thất bại");
        }
        else{
            session()->flash("success", "Cập nhật danh mục thành công");
        }
        return redirect()->back();
    }
}
