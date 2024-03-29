<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{ProductCategory, ProductType, Product};
use DataTables;
use Alert;

class ProductCategoryController extends Controller
{
    function __construct()
    {
        $this->productCategory_data = ProductCategory::with('productType');
    }
    function index()
    {
        $productCategory_data = $this->productCategory_data->get();
        $productType_data = ProductType::get();
        return view('product_category.index',compact('productType_data','productCategory_data'));
    }
    function productCategoryJson()
    {
        return Datatables::of($ProductCategory_data)->addIndexColumn()->make(true);
            // ->addColumn('productCategory',function (Product $product){
            //     return $product->productCategory->category_name;
            // })
            // ->toJson();
    }
    function store(Request $request)
    {
        $productCategory_data = new ProductCategory();
        $productCategory_data->category_name = $request->get('category_name');
        $productCategory_data->product_type_id = $request->get('product_type_id');
        $productCategory_data->save();

        Alert::success('Sukses','Data Kategori berhasil ditambah!');
        return redirect()->back();
    }

    function edit($id_product_category)
    {
        $productCategory_data = $this->productCategory_data->find($id_product_category);
        return response()->json([
            'data' => $productCategory_data
        ]);
    }

    function update(Request $request, $id_product_category)
    {
        $productCategory_data = ProductCategory::findOrFail($id_product_category); 
        $productCategory_data->category_name = $request->get('category_name');
        // $productCategory_data->product_type_id = $request->get('product_type_id');
        $productCategory_data->save();

        Alert::success('Sukses','Data Kategori berhasil diubah!');
        return redirect()->back();
    }

    function delete(Request $request, $id_product_category)
    {
        $productWhereHas_data = Product::where('product_category_id',$request->route('id_product_category'))->first();
        if(!$productWhereHas_data){
            DB::transaction(function() use ($id_product_category){
                $productCategory_data = ProductCategory::findOrFail($id_product_category); 
                $productCategory_data->delete();
            });
        } else {
            Alert::error('Error','Hapus Data Produk Terlebih dahulu !');
            return back();
        }
        
        Alert::success('Sukses','Data Produk Kategori berhasil dihapus !');
        return back();
    }
}
