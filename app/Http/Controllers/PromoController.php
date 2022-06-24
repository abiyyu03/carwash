<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ProductPromo, Product};
use Alert;
use DataTables;

class PromoController extends Controller
{
    function index()
    {
        if(request()->ajax()){
            $productPromo_data = ProductPromo::with('product')->get();
            return DataTables::of($productPromo_data)
                ->addIndexColumn()
                ->addColumn('product', function(ProductPromo $promo){
                    return $promo->product->product_name;
                })
                ->editColumn('action', function(ProductPromo $promo){
                    return '<a href="/promo/product'.$promo->id_promo.'/select-product" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a> 
                    <a href="/promo/product/delete/'.$promo->id_promo.'" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $product_data = Product::get();
        return view('promo.index',compact('product_data'));
    }

    function store(Request $request)
    {
        $product_data = $request->input('product_id');
        // dd($product_data);
        foreach ($product_data as $key => $product) {
            // dd($key);
            $productPromo_data = new ProductPromo();
            $productPromo_data->discount = $request->discount;
            $productPromo_data->product_id = $product;
            $productPromo_data->save();
        }
        Alert::success('Sukses','Promo berhasil dibuat');
        return redirect()->back();
        
    }
}
