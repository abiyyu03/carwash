<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use DataTables;
use Alert;

class InventoryController extends Controller
{
    function index()
    {
        return view('inventory.index');
    }

    function inventoryJson()
    {
        $inventory_data = Inventory::get();
        return Datatables::of($inventory_data)->addIndexColumn()->make(true);
            // ->addColumn('productCategory',function (Product $product){
            //     return $product->productCategory->category_name;
            // })
            // ->toJson();
    }
    function store(Request $request)
    {
        // $inventory_data = $request->all();
        // dd($inventory_data);
        $inventory_data = new inventory();
        $inventory_data->inventory_name = $request->inventory_name;
        $inventory_data->inventory_code = $request->inventory_code;
        $inventory_data->inventory_capital_price = $request->inventory_capital_price;
        $inventory_data->inventory_usable = $request->inventory_usable;
        $inventory_data->inventory_usage = $inventory_data->inventory_usable;
        $inventory_data->inventory_unit = 100;//$request->inventory_unit;
        // Inventory::create($inventory_data);
        $inventory_data->save();

        Alert::success('sukses','Data Inventory Berhasil Ditambahkan !');
        return redirect()->back();

    }
}
