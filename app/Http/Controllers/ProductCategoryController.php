<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_category;

class ProductCategoryController extends Controller
{
    function index()
    {
        return view('product_category.index');
    }

    function store(Request $request)
    {
        $productCategory_data = new Product_category();
        $productCategory_data->category_name = $request->get('category_name');
        $productCategory_data->save();
        return redirect()->back();
    }
}
