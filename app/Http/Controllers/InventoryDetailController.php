<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{InventoryDetail, Inventory, Product, Outcome};
use DB;
use Alert;

class InventoryDetailController extends Controller
{
    function index()
    {
        $inventoryDetail_data = InventoryDetail::with('inventory','product')->get();
        $inventory_data = Inventory::get();
        $product_data = Product::get();
        // $inventory_product = $inventory_data->merge($product_data);
        // dd($inventory_product);
        return view('shopping.index',compact('inventoryDetail_data','inventory_data','product_data'));
    }

    function store(Request $request)
    {
        // $inventoryDetail_data = $request->validate([
        //     // id_inventory_detail	inventory_detail_name	
        //     // inventory_detail_amount	inventory_detail_price	inventory_id	supplier_name	supplier_contact
        //     'inventory_detail_name' => ['required'], 
        //     'inventory_detail_amount' => ['required'], 
        //     'inventory_detail_price' => ['required'], 
        //     'inventory_id' => ['required'], 
        //     'product_id' => ['required'], 
        //     'supplier_name' => ['required'], 
        //     'supplier_contact' => ['required']

        // ]);
        // InventoryDetail::create($inventoryDetail_data);
        DB::transaction(function() use ($request){
            $inventoryDetail_data = new InventoryDetail();
            $inventoryDetail_data->inventory_detail_name = $request->inventory_detail_name;
            $inventoryDetail_data->inventory_detail_amount = $request->inventory_detail_amount;
            $inventoryDetail_data->inventory_detail_price = $request->inventory_detail_price;
            $inventoryDetail_data->inventory_id = $request->inventory_id;
            if($request->inventory_id != NULL)
            {
                $inventory_data = Inventory::find($request->inventory_id);
                $inventory_data->inventory_unit += $request->inventory_detail_amount;
                $inventory_data->inventory_capital_price += $request->inventory_detail_price;
                $inventory_data->save();
            }
            if($request->product_id != NULL)
            {
                $product_data = Product::find($request->product_id);
                $product_data->product_stock += $request->inventory_detail_amount;
                $product_data->product_capital_price += $request->inventory_detail_price;
                $product_data->save();
            }
            $inventoryDetail_data->product_id = $request->product_id;
            // $inventoryDetail_data->supplier_name = $request->supplier_name;
            // $inventoryDetail_data->supplier_contact = $request->supplier_contact;
            $inventoryDetail_data->save();
            
            $outcome_data = new Outcome();
            $outcome_data->needs = $request->inventory_detail_name;
            $outcome_data->quantity = $request->inventory_detail_amount;
            $outcome_data->expense_balance = $request->inventory_detail_price;
            $outcome_data->save();
        });
        Alert::success('Sukses','Data Belanja berhasil Ditambah !');
        return back();
    }

    function delete($id_inventory_detail)
    {
        $inventoryDetail_data = InventoryDetail::find($id_inventory_detail);
        $inventoryDetail_data->delete();

        Alert::success('Sukses','Data Belanja berhasil dihapus !');
        return back();
    }

    function update(Request $request, $id_inventory_detail)
    {
        $inventoryDetail_data = InventoryDetail::find($id_inventory_detail);
        // $inventoryDetail_data->inventory_id = $request->inventory_id;
        $dividePrice = abs($inventoryDetail_data->inventory_detail_price - $request->inventory_detail_price);
        $divideUnit = abs($inventoryDetail_data->inventory_detail_amount - $request->inventory_detail_amount);
        
        $inventoryDetail_data->inventory_detail_name = $request->inventory_detail_name;
        $inventoryDetail_data->inventory_detail_amount = $request->inventory_detail_amount;
        $inventoryDetail_data->inventory_detail_price = $request->inventory_detail_price;
        
        //check product or inventory
        if($inventoryDetail_data->inventory_id != NULL)
        {
            $inventory_data = Inventory::find($inventoryDetail_data->inventory_id);
            if($inventory_data->inventory_unit > $request->inventory_detail_amount) {
                $inventory_data->inventory_unit -= $divideUnit; 
            } elseif ($inventory_data->inventory_unit < $request->inventory_detail_amount) {
                $inventory_data->inventory_unit += $divideUnit;
            }

            if($inventory_data->inventory_detail_price > $request->inventory_detail_price) {
                $inventory_data->inventory_detail_price -= $dividePrice; 
            } elseif ($inventory_data->inventory_detail_price < $request->inventory_detail_price) {
                $inventory_data->inventory_detail_price += $dividePrice;
            }

            // if($inventory_data->inventory_capital_price > $request->inventory_capital_price) {
            //     $inventory_data->inventory_capital_price -= $dividePrice; 
            // } elseif ($inventory_data->inventory_capital_price < $request->inventory_capital_price) {
            //     $inventory_data->inventory_capital_price += $dividePrice;
            // }
            $inventory_data->save();
        }
        if($inventoryDetail_data->product_id != NULL)
        {
            $product_data = Product::find($inventoryDetail_data->product_id);
            if($product_data->product_stock > $request->inventory_detail_amount) {
                $product_data->product_stock -= $divideUnit;
            } else {
                $product_data->product_stock += $divideUnit;
            }

            if($product_data->product_capital_price > $request->inventory_detail_price) {
                $product_data->product_capital_price -= $dividePrice;
            } else {
                $product_data->product_capital_price += $dividePrice;
            }
            $product_data->save();
        }
        // $inventoryDetail_data->product_id = $request->product_id;
        $inventoryDetail_data->supplier_name = $request->supplier_name;
        $inventoryDetail_data->supplier_contact = $request->supplier_contact;
        $inventoryDetail_data->save();

        Alert::success('Sukses','Data Belanja berhasil diubah !');
        return back();
    }
}
