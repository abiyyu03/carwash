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
        $inventory_data = Inventory::get();
        return view('inventory.index',compact('inventory_data'));
    }

    function inventoryJson()
    {
        $inventory_data = Inventory::get();
        return Datatables::of($inventory_data)->addIndexColumn()->make(true);
            // ->addColumn('productCategory',function (Product $product){
            //     return $product->productCategozzry->category_name;
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
        // $inventory_data->inventory_capital_price = $request->inventory_capital_price;
        $inventory_data->inventory_usable = $request->inventory_usable;
        $inventory_data->inventory_usage = $inventory_data->inventory_usable;
        // $inventory_data->inventory_unit = 100;//$request->inventory_unit;
        // Inventory::create($inventory_data);
        $inventory_data->save();

        Alert::success('sukses','Data Inventory Berhasil Ditambahkan !');
        return redirect()->back();

    }

    function update(Request $request, $id_inventory)
    {
        $inventory_data = Inventory::findOrFail($id_inventory);
        $inventory_data->inventory_name = $request->inventory_name;
        $inventory_data->inventory_code = $request->inventory_code;
        $inventory_data->inventory_capital_price = $request->inventory_capital_price;
        $inventory_data->inventory_usable = $request->inventory_usable;
        $inventory_data->inventory_unit = $request->inventory_unit;
        $inventory_data->save();

        Alert::success('Sukses','Data Inventory Berhasil Diubah !');
        return redirect()->back();
    }

    function delete($id_inventory)
    {
        $inventory_data = Inventory::findOrFail($id_inventory);
        $inventory_data->delete();

        Alert::success('Sukses','Data Inventory Berhasil Dihapus !');
        return back();
    }
}
