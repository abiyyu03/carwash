<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use DataTables;

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
        $inventory_data = $request->all();
        Inventory::create($inventory_data);
        return redirect()->back();

    }
}
