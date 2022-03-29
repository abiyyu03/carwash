<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function create()
    {
        return view('transaction.createCustomer');
    }
}
