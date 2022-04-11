<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function index()
    {
        return view('inventory.index');
    }
}
