<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Customer, VehicleType, Transaction, TransactionDetail, Product};
use Lava;
use DataTables;

class DashboardController extends Controller
{
    function index()
    {
        $chart = Lava::DataTable();
        $chart->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');

        // Random Data For Example
        for ($a = 1; $a < 30; $a++) {
            $chart->addRow([
            '2015-10-' . $a, rand(800,1000), rand(800,1000)
            ]);
        }
        Lava::LineChart('MyStocks', $chart);
        
        $transaction_data = $this->getAllTransaction();
        $transactionPending_data = $this->getAllTransaction();
        $product_data = $this->getProduct();
        return view('dashboard.index',compact('transaction_data','transactionPending_data','product_data'));
    }

    function getPendingTransaction()
    {
        return Transaction::with('customer','employee')
                ->where('transaction_status','=','pending')
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
