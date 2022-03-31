<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Product,Product_category};

class ProductController extends Controller
{
    function index()
    {
        return view('product.index');
    }

    function store(Request $request)
    {
        //
    }
}
