<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductFormRequest;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\SizeService;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;


class ProductController extends Controller
{   
    protected $productService;
    protected $sizeService;

    public function __construct(ProductService $productService, SizeService $sizeService){
        $this->productService = $productService;
        $this->sizeService = $sizeService;
    }

    // Show page to add product
    public function addProduct()
    {   
        return view("admin.products.add", [
            "title" => "Thêm Sản Phẩm",
            "breadcrumb" => "Thêm Sản Phẩm",
            'menus' => $this->productService->getMenuList(),
            "sizes" => $this->sizeService->getAllSizes()
        ]);
    }

    // Save product when adding
    public function storeProduct(ProductFormRequest $request)
    {
        // Remove file, _token because don't need
        $data = $request->except(['file', '_token']);
        $data["slug"] = Str::slug($data["name"]);

        $result = $this->productService->insertProductRow($data);

        if(!$result){
            session()->flash("error", "Thêm mới sản phẩm thất bại");
        }
        else{
            session()->flash("success", "Thêm mới sản phẩm thành công");
        }
        
        return redirect()->back();
    }

    // Show product list
    public function listProduct()
    {   
        return view("admin.products.list", [
            "title" => "Danh Sách Sản Phẩm",
            "breadcrumb" => "Danh Sách Sản Phẩm",
        ]);
    }

    // Get product list to add to datatable's ajax manager
    public function getProductList()
    {
        $products = $this->productService->getAllProducts();
        return DataTables::of($products)->make(true);
    }

    // Delete product
    public function deleteProduct(Request $request)
    {
        $id = $request->input('id');
        $result = $this->productService->deleteProductRow($id);

        return response()->json([
            "message" => $result,
        ]);
    }

    // Delete multiple product
    public function deleteMultipleProducts(Request $request)
    {
        $arrayOfID = $request->input("array_of_id");
        $result = $this->productService->deleteMultipleRow($arrayOfID);

        return response()->json([
            "message" => $result,
        ]);
    }

    // Show page to edit product
    public function editProduct(Product $product)
    {     
        return view('admin.products.edit', [
            "title" => "Chỉnh sửa sản phẩm",
            "breadcrumb" => "Chỉnh sửa sản phẩm",
            "product" => $product,
            "menus" => $this->productService->getMenuList()
        ]);
    }

    // Update product when editing
    public function updateProduct(Product $product, ProductFormRequest $request){
        $data = $request->except(['file', '_token']);
        $data["slug"] = Str::slug($data["name"]);
        $result = $this->productService->updateProductRow($product, $data);
        if(!$result){
            session()->flash("error", "Cập nhật sản phẩm thất bại");
        }
        else{
            session()->flash("success", "Cập nhật sản phẩm thành công");
        }

        return redirect()->back();    
    }

    
}
