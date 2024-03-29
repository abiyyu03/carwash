<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,ProductCategory, Inventory};
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
        $inventory_data = Inventory::get();
        return view('product.index',compact('productCategory_data','product_data','inventory_data'));

    }
    // function indexes($id_product_category)
    // {
    //     $productCategory_data = ProductCategory::get();
    //     $inventory_data = Inventory::get();
    //     if(request()->submit_filter){
    //         $product_data = $this->product_data->where('product_category_id',$id_product_category)->get();
    //         return view('product.index',compact('productCategory_data','product_data','inventory_data'));
    //     }
    // }

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
            // 'product_code' => ['required'],
            'product_price' => ['required'],
            // 'product_stock' => ['required'],
            // 'product_image' => ['required'],
            'product_category_id' => ['required']
        ]);

        DB::transaction(function() use ($request, $storeProductImageAction){
            $product_data = new Product();
            $product_data->product_name = $request->product_name;
            $product_data->product_code = $this->getProductCode($request);
            $product_data->product_price = $request->product_price;
            // $product_data->product_capital_price = $request->product_capital_price;
            // $product_data->product_stock = $request->product_stock;
            $product_data->product_minimum_stock = ($request->product_minimum_stock == NULL) ? 0 : $request->product_minimum_stock;
            // $product_data->product_discount = $request->product_discount;
            $product_data->product_category_id = $request->product_category_id;
            $product_data->is_active = '1';
            $product_data->save();

            //store inventory data used
            $product_data->inventories()->attach($request->input('inventory_id'));
        });
        Alert::success('Sukses','Data Produk berhasil disimpan');
        return redirect()->back(); //->with('success','Data Produk berhasil disimpan');
    }

    function delete($id_product)
    {
        DB::transaction(function() use ($id_product){
            $product_data = $this->product_data->find($id_product);
            //check if image data is exist
            // if($product_data->product_image != NULL)
            // {
            //     unlink(public_path('/img/product/'.$product_data->product_image));
            // }
            $product_data->delete();
        });
        Alert::success('Sukses','Data Produk berhasil dihapus !');
        return redirect()->back();
    }

    function changeProductStatus($id_product)
    {
        $product_data = Product::find($id_product);
        if($product_data->is_active == '0'){
            $product_data->is_active = '1';
            $product_data->save();
            Alert::success('sukses','Status produk aktif !');
        } else {
            $product_data->is_active = '0';
            $product_data->save();
            Alert::success('sukses','Status produk aktif !');
        }
        return back();

    }
    function getProductCode(Request $request)
    {
        return strtoupper(substr($request->product_name,0,2)).$request->product_minimum_stock.$request->product_category_id;
    }

    function update(Request $request,$id_product)
    {
        $product_data = Product::findOrFail($id_product);
        $product_data->product_name = $request->product_name;
        $product_data->product_price = $request->product_price;
        // $product_data->product_capital_price = $request->product_capital_price;
        // $product_data->product_stock = $request->product_stock;
        $product_data->product_minimum_stock = ($request->product_minimum_stock == NULL) ? 0 : $request->product_minimum_stock;
        // $product_data->product_category_id = $request->product_category_id;
        $product_data->save();
        
        Alert::success('Sukses','Data produk berhasil diubah !');
        return back();
    }

    function addProductDiscount(Request $request, $id_product)
    {
        //calculate price of discount
        $discount = ($request->product_discount / 100) * $request->product_price; // count percentage

        $product_data = Product::findOrFail($id_product);
        $product_data->product_price -= $discount;
        $product_data->product_discount = $request->product_discount;
        $product_data->save();
        
        Alert::success('Sukses','Diskon berhasil dibuat !');
        return back();
    }

    // function productCategoryFilter()
    // {
    //     $product_data = $this->product->get();
    //     if (request()->ajax()) {
            
    //     }
    // }

}
