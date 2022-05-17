<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,ProductCategory};
use Illuminate\Support\Facades\DB;
use App\Actions\Product\{StoreProductImageAction};
use Image;
use DataTables;
use Alert;

class ProductController extends Controller
{
    function __construct()
    {
        $this->product_data = Product::with('productCategory');
    }
    function index()
    {
        $productCategory_data = ProductCategory::get();
        $product_data = $this->product_data->get();
        return view('product.index',compact('productCategory_data','product_data'));
    }
    function productJson(Request $request)
    {
        if($request->ajax()){
            return Datatables::eloquent($this->product_data)
                ->addColumn('productCategory',function (Product $product){
                    return $product->productCategory->category_name;
                })
                ->addIndexColumn()
                ->toJson();
        }
    }

    function store(Request $request, StoreProductImageAction $storeProductImageAction)
    {
        //validate produk_data
        $product_data = $request->validate([
            'product_name' => ['required'],
            'product_code' => ['required'],
            'product_price' => ['required'],
            'product_stock' => ['required'],
            // 'product_image' => ['required'],
            'product_category_id' => ['required']
        ]);

        DB::transaction(function() use ($request, $storeProductImageAction){
            //upload cover product image
           if($request->file('product_image') != NULL)
           {
                $storeProductImageAction->executeProduct($request);
           }

            $product_data = new Product();
            $product_data->product_name = $request->product_name;
            $product_data->product_code = $request->product_code;
            $product_data->product_price = $request->product_price;
            $product_data->product_capital_price = $request->product_capital_price;
            $product_data->product_stock = $request->product_stock;
            $product_data->product_minimum_stock = $request->product_minimum_stock;
            $product_data->product_image =  $storeProductImageAction->filename;
            $product_data->product_category_id = $request->product_category_id;
            $product_data->save();
        });
        Alert::success('Sukses','Data Produk berhasil disimpan');
        return redirect()->back(); //->with('success','Data Produk berhasil disimpan');
    }

    function delete($id_product)
    {
        DB::transaction(function() use ($id_product){
            $product_data = $this->product_data->find($id_product);
            unlink(public_path('/img/product/'.$product_data->product_image));
            $product_data->delete();
        });
        Alert::success('Sukses','Data Produk berhasil dihapus !');
        return redirect()->back();
    }

    function edit($id_product)
    {
        
    }

    function update(Request $request,$id_product)
    {
        $product_data = Product::findOrFail($id_product);
        $product_data->product_name = $request->product_name; 
        $product_data->product_code = $request->product_code; 
        $product_data->product_stock = $request->product_stock; 
        $product_data->product_price = $request->product_price; 
        $product_data->product_category_id = $request->product_category_id; 
        $product_data->save();
        
        Alert::success('Sukses','Data produk berhasil diubah !');
        return back();
    }
}
