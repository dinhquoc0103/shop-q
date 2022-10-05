<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Slider\SliderFormRequest;
use App\Http\Services\Admin\SliderService;
use App\Models\Slider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class SliderController extends Controller
{   
    protected $sliderService;

    public function __construct(SliderService $sliderService){
        $this->sliderService = $sliderService;
    }

    // Show page to add slider
    public function addSlider()
    {
        return view('admin.sliders.add', [
            'title' => 'Thêm mới slider',
            "breadcrumb" => "Thêm mới slider"
        ]);
    }

    // Save slider when adding
    public function storeSlider(SliderFormRequest $request)
    {
        $data = $request->except(['file', '_token']);
        $data["slug"] = Str::slug($data["name"]);
        $result = $this->sliderService->insert($data);

        if(!$result){
            session()->flash("error", "Thêm mới slider thất bại");
        }
        else{
            session()->flash("success", "Thêm mới slider thành công");
        }
        return redirect()->back();
    }

    // Show slider list
    public function listSlider()
    {
        return view("admin.sliders.list", [
            "title" => "Danh Sách Slider",
            "breadcrumb" => "Danh Sách Slider",
        ]);
    }

    // Get slider list to add to datatable's ajax manager
    public function getSliderList()
    {
        $sliders = $this->sliderService->getAllSliders();
        return DataTables::of($sliders)->make(true);
    }

    // Delete slider
    public function deleteSlider(Request $request)
    {
        $id = $request->input('id');
        $result = $this->sliderService->deleteSliderRow($id);

        return response()->json([
            "message" => $result,
        ]); 
    }

    // Delete multiple slider
    public function deleteMultipleSliders(Request $request)
    {
        $arrayId = $request->input("array_of_id");
        $result = $this->sliderService->deleteMultipleRow($arrayId);

        return response()->json([
            "message" => $result,
        ]);
    }

    // Show page to edit slider
    public function editSlider(Slider $slider)
    {
        return view('admin.sliders.edit', [
            "title" => "Chỉnh sửa slider",
            "breadcrumb" => "Chỉnh sửa slider",
            "slider" => $slider
        ]);
    }

    // Update slider when editing
    public function updateSlider(SliderFormRequest $request, Slider $slider)
    {
        $data = $request->input();
        $result = $this->sliderService->updateSliderRow($data, $slider);

        if(!$result){
            session()->flash("error", "Cập nhật slider thất bại");
        }
        else{
            session()->flash("success", "Cập nhật slider thành công");
        }

        return redirect()->back();
    }
}
