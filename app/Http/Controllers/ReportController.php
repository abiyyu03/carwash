<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transaction, Product, TransactionDetail};
use Alert;

class ReportController extends Controller
{
    function index()
    {
        $transactionDetail_data = TransactionDetail::get();
        return view('report.index');
    }

    function dailyReport()
    {
        $now = \Carbon\Carbon::today();
        // dd(date('Y-m-d'));
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))->get();
        return view('report.daily',compact('transactionDetail_data'));
    }
    function monthlyReport()
    {
        $now = \Carbon\Carbon::today();
        // dd(date('Y-m-d'));
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))->get();
        return view('report.monthly',compact('transactionDetail_data'));
    }
}
