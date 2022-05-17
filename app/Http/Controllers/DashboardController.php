<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Customer, VehicleType, Transaction, Product};

class DashboardController extends Controller
{
    function index()
    {
        $transaction_data = $this->getAllTransaction();
        $transactionPending_data = $this->getAllTransaction();
        $product_data = $this->getProduct();
        return view('dashboard.index',compact('transaction_data','transactionPending_data','product_data'));
    }

    function getPendingTransaction()
    {
        return Transaction::with('customer')
                ->where('transaction_status','pending')
                ->get();
    }
    function getAllTransaction()
    {
        return Transaction::with('customer')->get();
    }

    function getProduct()
    {
        return Product::with('productCategory')->get();
    }
}
