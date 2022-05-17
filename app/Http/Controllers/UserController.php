<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Role};
use DataTables;

class UserController extends Controller
{
    function index()
    {
        $user_data = User::with('role')->get();
        return view('user.index',compact('user_data'));
    }
    function userJson()
    {
        $user_data = User::with('role')->get();
        return Datatables::of($user_data)->addIndexColumn()->make(true);
            // ->addColumn('productCategory',function (Product $product){
            //     return $product->productCategory->category_name;
            // })
            // ->toJson();
    }
    
}
