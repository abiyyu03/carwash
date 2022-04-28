<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use DataTables;

class ProductCategoryController extends Controller
{
    function index()
    {
        return view('product_category.index');
    }
    function productCategoryJson()
    {
        $ProductCategory_data = ProductCategory::get();
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
        $productCategory_data->save();
        return redirect()->back();
    }
}
