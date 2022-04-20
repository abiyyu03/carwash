<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    function index()
    {
        return view('inventory.index');
    }
    function store(Request $request)
    {
        $inventory_data = $request->all();
        Inventory::create($inventory_data);
        return redirect()->back();

    }
}
