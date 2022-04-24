<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class TransactionController extends Controller
{
    function checkout()
    {
        $employee_data = Employee::get(); 
        return view('transaction.transaction',compact('employee_data'));
    }

    function createCustomer()
    {
        return view('transaction.transaction');
    }
}
