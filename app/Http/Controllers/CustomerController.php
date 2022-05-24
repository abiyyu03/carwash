<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Customer, Transaction};
use DataTables;
use Alert;

class CustomerController extends Controller
{
    function index()
    {
        $customer_data = Customer::get();
        return view ('customer.index',compact('customer_data'));
    }

    function customerJson()
    {
        $customer_data = Customer::get();
        return Datatables::of($customer_data)
                    ->addIndexColumn()
                    ->make(true);
    }

    function delete($id_customer)
    {
        //get customer's transaction
        $transactionCustomer_data = Transaction::whereHas('customer', function($query){ 
            $query->where('customer_id',request()->route('id_customer')); 
        })->first();

        //check if customer's transaction is doesnt exist
        if(!$transactionCustomer_data){
            $customer_data = Customer::find($id_customer);
            $customer_data->delete();

            Alert::success('Sukses','Data Customer Berhasil Dihapus !');
            return back();
        }
        Alert::error('Gagal','Hapus transaksi Customer yang bersangkutan terlebih dahulu !');
        return back();
    }

    function update(Request $request, $id_customer)
    {
        $customer_data = Customer::find($id_customer);
        $customer_data->customer_name = $request->customer_name;
        $customer_data->customer_contact = $request->customer_contact;
        $customer_data->customer_vehicle = $request->customer_vehicle;
        $customer_data->customer_license_plate = $request->customer_license_plate;
        $customer_data->save();

        Alert::success('Sukses','Data Customer Berhasil Diubah !');
        return back();
    }
    
}
