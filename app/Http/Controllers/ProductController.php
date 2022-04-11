<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,ProductCategory};
use Image;
use DataTables;

class ProductController extends Controller
{
    function index()
    {
        $productCategory_data = ProductCategory::get();
        // $product_data = Product::with('productCategory')->get();
        // return Datatables::of(Product::with('productCategory')->get())->make(true);
        return view('product.index',compact('productCategory_data'));
    }
    function productJson(Request $request)
    {
        if($request->ajax()){
            $product_data = Product::with('productCategory');
            return Datatables::eloquent($product_data)
                ->addColumn('productCategory',function (Product $product){
                    return $product->productCategory->category_name;
                })
                ->toJson();
        }
    }

    function store(Request $request)
    {
        //validate produk_data
        $produk_data = $request->validate([
            'product_name' => ['required'],
            'product_code' => ['required'],
            'product_description' => ['required'],
            'product_price' => ['required'],
            'product_stock' => ['required'],
            'image' => ['required'],
            'product_category_id' => ['required']
        ]);

        //upload cover product image
        $image = $request->file('image');
        $filename = $image->getClientOriginalName();

        $image->move(public_path().'/img/img_temp/',$filename);
        $image_compressed = Image::make(public_path().'/img/img_temp/'.$filename);
        $image_compressed->fit(240,120);
        $image_compressed->save(public_path('/img/product/'.$filename));
        unlink(public_path('/img/img_temp/'.$filename));

        $product_data = new Product();
        $product_data->product_name = $request->get('product_name');
        $product_data->product_code = $request->get('product_code');
        $product_data->product_description = $request->get('product_description');
        $product_data->product_price = $request->get('product_price');
        $product_data->product_stock = $request->get('product_stock');
        $product_data->image = $filename;
        $product_data->product_category_id = $request->get('product_category_id');
        $product_data->save();
        return redirect()->back()->with('success','Data Produk berhasil disimpan');
    }

    // function jsonProduct()
    // {
    //     return Datatables::of(Product::with('productCategory')->get())->make(true);
    // }
}
