<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;

class CustomerController extends Controller
{
    function index()
    {
        return view ('customer.index');
    }

    function customerJson()
    {
        $customer_data = Customer::get();
        return Datatables::of($customer_data)->addIndexColumn()->make(true);
    }
    
}
