<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transaction, Product, TransactionDetail, Customer, Employee, InventoryDetail, Outcome};
use Illuminate\Support\Facades\DB;
use Alert;
use Carbon\Carbon;
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
        // $total = $this->getTotal();
        // $soldProduct = $this->soldProduct();
        $getTransactionTotal = $this->getTransactionTotal();
        // $transaction_data = Transaction::get();

        //if in range date filter
        if(request()->ajax()){
            if(!empty(request()->from_date)){    
                $transaction_data = Transaction::with('employee','customer')
                    ->whereBetween('transaction_timestamp',[request()->from_date,request()->to_date])
                    ->where('transaction_status',"=","complete")
                    ->get();
                } else {
                    $transaction_data = Transaction::with('employee','customer')
                    ->where('transaction_status',"=","complete")
                    ->get();
            }
            return DataTables()->of($transaction_data)
                ->addIndexColumn()
                // ->with('transaction_data')
                ->editColumn('transaction_date', function(Transaction $transaction){
                    return $transaction->created_at ? with(new Carbon($transaction->created_at))->isoFormat('dddd, D MMMM Y')/*->diffForHumans()*/ : '';
                })
                ->editColumn('transaction_time', function(Transaction $transaction){
                    return $transaction->created_at ? with(new Carbon($transaction->created_at))->isoFormat('HH:mm')/*->diffForHumans()*/ : '';
                })
                ->addColumn('employee',function (Transaction $transaction){
                    return $transaction->employee->employee_fullname;
                })
                ->addColumn('customer_name',function (Transaction $transaction){
                    return $transaction->customer->customer_name;
                })
                ->addColumn('customer_license_plate',function (Transaction $transaction){
                    return $transaction->customer->customer_license_plate;
                })
                ->toJson();
        }
        return view('report.daily.daily',compact('getTransactionTotal'));
    }

    function monthlyReport()
    {
        $getTransactionTotal =  Transaction::where('transaction_status','complete')->sum('transaction_grandtotal');
        // $soldProduct = $this->soldProduct();
        //if in range date filter
        if(request()->ajax()){
            if(!empty(request()->from_date)){
                // $transactionDetail_data = TransactionDetail::with('product')
                // ->groupBy('product_id')
                // ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                // ->selectRaw('product_id, sum(transaction_detail_amount) as transaction_detail_amount')
                // ->whereBetween('transaction_detail_date',[request()->from_date,request()->to_date])
                // ->get();
                $transaction_data = Transaction::with('employee','customer')
                    ->whereBetween('transaction_timestamp',[request()->from_date,request()->to_date])
                    ->get();
            } else {
                // $transactionDetail_data = TransactionDetail::with('product')
                // ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                // ->selectRaw('product_id, sum(transaction_detail_amount) as transaction_detail_amount')
                // ->whereBetween('transaction_detail_date',[now()->subMonths(1)])
                // ->groupByRaw('product_id')
                // ->get();
                $transaction_data = Transaction::with('employee','customer')
                    ->where('transaction_timestamp',now()->subMonths(1))
                    ->get();
            }
            return DataTables()->of($transaction_data)
                ->addIndexColumn()
                // ->with('transaction_data')
                ->editColumn('transaction_date', function(Transaction $transaction){
                    return $transaction->created_at ? with(new Carbon($transaction->created_at))->isoFormat('dddd, D MMMM Y')/*->diffForHumans()*/ : '';
                })
                ->editColumn('transaction_time', function(Transaction $transaction){
                    return $transaction->created_at ? with(new Carbon($transaction->created_at))->isoFormat('HH:mm')/*->diffForHumans()*/ : '';
                })
                ->addColumn('employee',function (Transaction $transaction){
                    return ($transaction->employee->employee_fullname === 0) ? 0 :  $transaction->employee->employee_fullname;
                })
                ->addColumn('customer_name',function (Transaction $transaction){
                    return $transaction->customer->customer_name;
                })
                ->addColumn('customer_license_plate',function (Transaction $transaction){
                    return $transaction->customer->customer_license_plate;
                })
                ->toJson();
        }
        return view('report.month.monthly',compact('getTransactionTotal'));
    }

    function summaryReport()
    {
        $inventoryDetail_data = InventoryDetail::selectRaw('sum(inventory_detail_price) as inventory_detail_price')->first();
        $outcome_data = Outcome::selectRaw('sum(expense_balance) as expense_balance')->first();
        $getTransactionTotal = $this->getTransactionTotal();
        // $soldProduct = $this->soldProduct();
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))
                ->groupBy('product_id')
                ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                ->selectRaw('sum(transaction_detail_amount) as transaction_detail_amount')
                ->get();
                // dd($transactionDetail_data);
                return view('report.daily.summary',compact('transactionDetail_data','getTransactionTotal'));
    }

    function reportAllProduct()
    {
        $getTransactionTotal = Transaction::where('transaction_status','complete')->sum('transaction_grandtotal');
        // return $getTransactionTotal;
        $transactionDetail_data = TransactionDetail::whereHas('transaction', function($query){ 
            $query->where('transaction_status','success'); 
        })->get();
        $transaction_data = Transaction::where('transaction_status','complete')->get();
        //if in range date filter
        if(request()->ajax()){
            if(!empty(request()->from_date)){
                $transactionDetail_data = TransactionDetail::with('product','transaction')
                    ->groupBy('product_id')
                    ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('product_id, sum(transaction_detail_amount) as transaction_detail_amount')
                    ->whereBetween('transaction_detail_date',[request()->from_date,request()->to_date])
                    ->get();
                // $transactionDetail_data = DB::table('products')
                //     ->join('transaction_details', function($join){
                //         $sql->on('transaction_details.product_id', '=', 'products.id_product','left outer')
                //             ->whereBetween('transaction_details.transaction_detail_date',["request()->from_date",request()->to_date]);
                //     })
                //     ->groupBy('products.product_name')
                //     ->selectRaw('product_name as product_name')
                //     // ->selectRaw('transaction_details.transaction_detail_date as transaction_detail_date')
                //     ->selectRaw('sum(transaction_details.transaction_detail_total) as transaction_detail_total')
                //     ->selectRaw('sum(transaction_details.transaction_detail_amount) as transaction_detail_amount')
                    
                //     ->get();
                    // $transaction_data->whereBetween('transaction_date',[request()->from_date,request()->to_date]);
                } else {
                // $transactionDetail_data = TransactionDetail::with('product','transaction')
                //     ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                //     ->selectRaw('product_id, sum(transaction_detail_amount) as transaction_detail_amount')
                //     ->groupByRaw('product_id')
                //     // ->where('transaction.transaction_status','complete')
                //     ->get();
                $transactionDetail_data = DB::table('products')
                    ->join('transaction_details', 'transaction_details.product_id', '=', 'products.id_product','left outer')
                    ->selectRaw('product_name as product_name')
                    // ->selectRaw('transaction_details.transaction_detail_date as transaction_detail_date')
                    ->selectRaw('sum(transaction_details.transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('sum(transaction_details.transaction_detail_amount) as transaction_detail_amount')
                    ->groupBy('products.product_name')
                    ->get();
            }    
                return DataTables()->of($transactionDetail_data)
                    ->addIndexColumn()
                    // ->with('transaction_data')
                    // ->editColumn('transaction_details',function ($transactionDetail_data){
                    //     return ($transactionDetail_data->product_name === NULL) ? '0' : $transactionDetail_data->product_name;
                    // })
                    ->toJson();
                }
        // dd($transactionDetail_data);
        return view('report.all-product',compact('getTransactionTotal','transaction_data','transactionDetail_data'));
    }


    function getGrossTransactionTotal()
    {
        $total = 0;
        $transaction_data = Transaction::get();
        foreach ($transaction_data as $transaction) 
        {
            $total += $transaction->transaction_grandtotal;
        }
        // return response()->json($total);
        return $total;
    }

    function getCustomer()
    {
        return Customer::get();
    }

    function getOutcome()
    {
        $inventoryDetail_data = InventoryDetail::selectRaw('sum(inventory_detail_price) as inventory_detail_price')->get();
        dd($inventoryDetail_data);
        $outcome_data = Outcome::get();
        foreach ($inventoryDetail_data as $inventoryDetail) {
            
        }
        foreach ($outcome_data as $outcome) {
            # code...
        }
    }
}
