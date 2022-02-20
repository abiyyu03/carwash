<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function indexOwner()
    {
        return view('owner.product.index');
    }

    public function indexCashier()
    {
        return view('cashier.product.index');
    }
}
