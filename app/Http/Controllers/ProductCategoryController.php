<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    function index()
    {
        return view('product_category.index');
    }

    function store(Request $request)
    {
        $productCategory_data = new ProductCategory();
        $productCategory_data->category_name = $request->get('category_name');
        $productCategory_data->save();
        return redirect()->back();
    }
}
