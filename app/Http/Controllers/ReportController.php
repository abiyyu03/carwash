<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transaction, Product, TransactionDetail};
use Illuminate\Support\Facades\DB;
use Alert;
use DataTables;

class ReportController extends Controller
{
    function index()
    {
        $transactionDetail_data = TransactionDetail::get();
        return view('report.index');
    }

    function dailyReport()
    {
        $total = $this->getTotal();
        $soldProduct = $this->soldProduct();
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))
                ->groupBy('product_id')
                ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                ->selectRaw('sum(transaction_detail_amount) as transaction_detail_amount')
                ->get();
        // dd($transactionDetail_data);
        return view('report.daily.daily',compact('transactionDetail_data','total','soldProduct'));
    }

    function monthlyReport()
    {
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))->get();
        return view('report.monthly.monthly',compact('transactionDetail_data'));
    }

    function summaryReport()
    {
        $total = $this->getTotal();
        $soldProduct = $this->soldProduct();
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))
                ->groupBy('product_id')
                ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                ->selectRaw('sum(transaction_detail_amount) as transaction_detail_amount')
                ->get();
                // dd($transactionDetail_data);
                return view('report.daily.summary',compact('transactionDetail_data','total','soldProduct'));
    }

    function reportAll()
    {
        $total = $this->getTotal();
        $soldProduct = $this->soldProduct();
        //if in range date filter
        if(request()->ajax()){
            if(!empty(request()->from_date)){
                $transactionDetail_data = TransactionDetail::with('product')
                    ->groupBy('product_id')
                    ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('product_id, sum(transaction_detail_amount) as transaction_detail_amount')
                    ->whereBetween('transaction_detail_date',[request()->from_date,request()->to_date])
                    ->get();
                } else {
                $transactionDetail_data = TransactionDetail::with('product')
                    ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('product_id, sum(transaction_detail_amount) as transaction_detail_amount')
                    ->groupByRaw('product_id')
                    ->get();
            }
            return DataTables()->of($transactionDetail_data)
                ->addIndexColumn()
                ->addColumn('product',function (TransactionDetail $transactionDetail){
                    return $transactionDetail->product->product_name;
                })
                ->toJson();
        }
        // dd($transactionDetail_data);
        return view('report.all',compact('total','soldProduct'));
    }

    function getTotal()
    {
        $total = 0;
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))->get();
        foreach ($transactionDetail_data as $transactionDetail) 
        {
            $total += $transactionDetail->transaction_detail_total;
        }
        return $total;
    }

    function soldProduct()
    {
        $soldProduct = 0;
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))->get();
        foreach ($transactionDetail_data as $transactionDetail) 
        {
            $soldProduct += $transactionDetail->transaction_detail_amount;
        }
        return $soldProduct;
    }
}
