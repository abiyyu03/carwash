<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function index()
    {
        return view('invoice.index');
    }
}
