<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transaction, TransactionDetail, Employee, Customer, Product};
use Lava;
use DB;

class ChartController extends Controller
{
    // waktu teramai
    function busiestTime()
    {
        // $data = TransactionDetail::with('product','transaction')
        //     ->groupBy('product_category_id')
        //     ->selectRaw('product_category_id, sum(transaction_detail_total) as transaction_detail_total')
        //     ->selectRaw('product_category_id, sum(transaction_detail_amount) as transaction_detail_amount')
        //     ->get();
        if (request()->ajax()) {
            if(!empty(request()->based_filter == "month"))
            {
                if(!empty(request()->from_date)) {
                    $chart = TransactionDetail::with('product','transaction')
                    ->selectRaw('month(created_at) as month')
                    ->selectRaw('transaction_detail_amount as amount')
                    ->whereBetween('transaction_detail_date',[request()->from_date, request()->to_date])
                    ->pluck('amount','month');
                } else {
                    $chart = TransactionDetail::with('product','transaction')
                    ->selectRaw('month(created_at) as month')
                    ->selectRaw('transaction_detail_amount as amount')
                    // ->whereBetween('transaction_detail_date',[request()->from_date, request()->to_date])
                    ->pluck('amount','month');
                }
            } elseif(!empty(request()->based_filter == "daily")) {
                $chart = TransactionDetail::with('product','transaction')
                    ->selectRaw('day(created_at) as day')
                    ->selectRaw('transaction_detail_amount as amount')
                    ->pluck('amount','day');
            } elseif(!empty(request()->based_filter == "hourly")) {
                $chart = TransactionDetail::with('product','transaction')
                    ->selectRaw('time(created_at) as time')
                    ->selectRaw('transaction_detail_amount as amount')
                    ->pluck('amount','time');
            }else {
                $chart = TransactionDetail::with('product','transaction')
                    ->selectRaw('date(created_at) as date')
                    ->selectRaw('transaction_detail_amount as amount')
                    ->pluck('amount','date');
            }
            return response()->json($chart);
        } else {
            $chart = TransactionDetail::with('product','transaction')
                    ->selectRaw('DATE(created_at) as date')
                    ->selectRaw('transaction_detail_amount as amount')
                    ->pluck('amount','date');

            $labels = $chart->keys();
            $data = $chart->values();
        }


        return view('analysis.busiest-time',compact('labels','data'));
    }


    // waktu teramai
    function productBestSeller()
    {
        $chart = DB::table('transaction_details')
            ->join('products','transaction_details.product_id','=','products.id_product')
            ->select('products.product_name as product_name')
            ->selectRaw('product_name,sum(transaction_detail_amount) as amount')
            ->groupBy('product_name')
            ->pluck('amount','product_name');

        $labels = $chart->keys();
        $data = $chart->values();

        return view('analysis.best-seller-product',compact('labels','data'));
    }
    
    function categoryBestSeller()
    {
        $chart = DB::table('transaction_details')
            ->join('product_categories','transaction_details.product_category_id','=','product_categories.id_product_category')
            ->select('product_categories.category_name as category_name')
            ->selectRaw('category_name,sum(transaction_detail_amount) as amount')
            ->groupBy('category_name')
            ->pluck('amount','category_name');

        $labels = $chart->keys();
        $data = $chart->values();

        return view('analysis.best-seller-category',compact('labels','data'));
    }
}
