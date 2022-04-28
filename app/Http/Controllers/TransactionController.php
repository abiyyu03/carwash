<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, Transaction, Customer, User, ProductCategory, VehicleType, TransactionDetail};
use Carbon\Carbon;
use DataTables;

class TransactionController extends Controller
{
    function index()
    {
        $customer_data = Customer::get();
        $vehicleType_data = VehicleType::get();
        $transaction_data = Transaction::with('customer','employee')->get();
        return view('transaction.index',compact('transaction_data','customer_data','vehicleType_data'));
    }

    function transactionJson(Request $request)
    {
        if($request->ajax()){
            $transaction_data = Transaction::with('customer','employee');
            return Datatables::eloquent($transaction_data)
                ->addColumn('customer',function (Transaction $transaction){
                    return $transaction->customer->customer_name;
                })
                ->addIndexColumn()
                // ->addColumn('employee',function (Transaction $transaction){
                //     return $transaction->employee->employee_name;
                // })
                ->toJson();
        }
    }

    function checkout($id_transaction)
    {
        $employee_data = Employee::get(); 
        $transaction_data = Transaction::with('customer','employee')->find($id_transaction);
        // $transactionDetail_data = TransactionDetail::with('transaction','product')->get();
        $transactionWhereHas_data = transactionDetail::whereHas('transaction', function($query){ 
            $query->where('transaction_id',request()->route('id_transaction')); 
        })->get();
        $productCategory_data = ProductCategory::get();
        return view('transaction.transaction',compact('employee_data','transaction_data','productCategory_data','transactionWhereHas_data'));
    }

    # get customer's data to store in transcation
    function createCustomerAndTransactionWithExistingCustomerData(Request $request)
    {
        // get data with spesific id 
        $customer_data = Customer::find($request->get('id_customer'));
        
        $employee_data = Employee::whereHas('user', function($query){ 
            $query->where('user_id',Auth()->user()->id_user); 
        })->first();

        date_default_timezone_set('Asia/Jakarta');

        $transaction_data = new Transaction();
        $transaction_data->id_transaction = rand();
        $transaction_data->customer_id = $customer_data->id_customer;
        $transaction_data->employee_id = $employee_data->id_employee;
        $transaction_data->transaction_timestamp = Carbon::now();
        $transaction_data->transaction_status = "pending";
        $transaction_data->save();

        return redirect()->to('transaction/'.$transaction_data->id_transaction.'/selectProduct');
    }

    function createCustomerAndTransactionWithNewCustomerData()
    {
        $customer_data = request()->validate([
            'customer_name' => ['required'],
            'customer_contact' => ['required'],
            'customer_license_plate' => ['required'], //and unique:customer
        ]);

        // Create customer data
        $customer_data = new Customer();
        $customer_data->customer_name = request()->get('customer_name');
        $customer_data->customer_contact = request()->get('customer_contact');
        $customer_data->customer_license_plate = request()->get('customer_license_plate');
        $customer_data->save();

        // get cashier's data to store in transcation
        $employee_data = Employee::whereHas('user', function($query){ $query->where('user_id',Auth()->user()->id_user); })->first();

        $transaction_data = new Transaction();
        $transaction_data->id_transaction = \Str::random();
        $transaction_data->customer_id = $customer_data->id_customer;
        $transaction_data->employee_id = $employee_data->id_employee;
        $transaction_data->transaction_timestamp = Carbon::now();
        $transaction_data->transaction_status = "pending";
        // dd($transaction_data->id_transaction);
        $transaction_data->save();
        return redirect()->to('transaction/'.$transaction_data->id_transaction.'/selectProduct');
                        //  ->with('customer_name', $customer_data->customer_name)
                        //  ->with('customer_license_plate', $customer_data->customer_license_plate);
        // return view('transaction.transaction', compact('customer_data','transaction_data'));
    }

    function storeTransactionDetail(Request $request)
    {
        $transactionDetail_data = new TransactionDetail();
        $transactionDetail_data->transaction_detail_amount = $request->get('transaction_detail_amount');
        $transactionDetail_data->product_id = $request->get('product_id');
        $transactionDetail_data->transaction_detail_price = 7000; //7000 is just example
        $transactionDetail_data->transaction_detail_total = ($request->get('transaction_detail_amount') * $transactionDetail_data->transaction_detail_price); 
        $transactionDetail_data->transaction_id = $request->get('transaction_id');
        $transactionDetail_data->save();
        // dd($transactionDetail_data);
        return redirect()->back();
    }

    function deleteTransaction()
    {
        //delete transaction data and its detail transactionv
    }
}
