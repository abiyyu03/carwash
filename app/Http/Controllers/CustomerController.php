<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function index()
    {
        return view ('customer.index');
    }
    
}
