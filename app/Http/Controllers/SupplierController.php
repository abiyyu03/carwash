<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use DataTables;

class SupplierController extends Controller
{
    function index(Request $request)
    {
        $supplier_data = Supplier::get();
        if($request->ajax()){
            return DataTables::of($supplier_data)
            ->editColumn('action', function(Supplier $supplier){
                return '<a href="/supplier/delete/'.$supplier->id_supplier.'" class="btn btn-info editButton" id="editButton"><i class="fas fa-pencil-alt"></i> Edit</a>
                <a href="/supplier/delete/'.$supplier->id_supplier.'" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
        }
        return view('supplier.index');
    }
}
