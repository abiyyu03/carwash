<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Alert;

class SupplierController extends Controller
{
    function index()
    {
        $supplier_data = Supplier::get();
        return view('supplier.index',compact('supplier_data'));
    }

    function store(Request $request)
    {
        $supplier_data = $request->validate([
            'supplier_name' => ['required'], 
            'supplier_address' => ['required'], 
            'supplier_contact' => ['required'], 
        ]);
        Supplier::create($supplier_data);
        Alert::success('Sukses','Data Suplier berhasil Ditambah !');
        return back();
    }

    function delete($id_supplier)
    {
        $supplier_data = Supplier::find($id_supplier);
        $supplier_data->delete();

        Alert::success('Sukses','Data Suplier berhasil dihapus !');
        return back();
    }

    function update(Request $request, $id_supplier)
    {
        $supplier_data = Supplier::find($id_supplier);
        $supplier_data->supplier_name = $request->supplier_name;
        $supplier_data->supplier_address = $request->supplier_address;
        $supplier_data->supplier_contact = $request->supplier_contact;
        $supplier_data->save();

        Alert::success('Sukses','Data Suplier berhasil diubah !');
        return back();
    }
}
