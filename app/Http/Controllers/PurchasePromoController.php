<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchasePromoController extends Controller
{
    function index()
    {
        return view('promo.per-purchase.index');
    }
}
