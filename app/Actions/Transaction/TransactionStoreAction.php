<?php
namespace App\Actions\Transaction;

use Illuminate\Http\Request;
use App\Models\{Employee, Transaction, Customer, User, ProductCategory, VehicleType, TransactionDetail, WorkDetail, Product, Inventory};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Alert;
use Cart;

class TransactionStoreAction
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');

        //instance objects
        $this->productCategory = new ProductCategory();
        $this->customer = new Customer();
        $this->product = new Product();
        $this->transaction = new Transaction();
        $this->workDetail = new WorkDetail();
        $this->transactionDetail = new TransactionDetail();
    }
    
    function saveTransactionDetail($product_id)
    {
        $product_data = $this->product->with('productCategory')->find($product_id);
        $this->transactionDetail->id_transaction_detail = request()->id_transaction_detail;
        $this->transactionDetail->product_id = request()->product_id;
        $this->transactionDetail->transaction_detail_amount = request()->transaction_detail_amount;
        $this->transactionDetail->transaction_detail_total = (request()->transaction_detail_amount * $product_data->product_price); 
        $this->transactionDetail->transaction_id = request()->transaction_id;
        // $this->transactionDetail->employeeWork_total = $employeeWork_total;
        $this->transactionDetail->save();
    }

    function saveTransaction($id_customer)
    {
        $customer_data = $this->customer->find($id_customer);
        $date = Carbon::now();
        
        // get cashier's data to store in transcation
        $employee_data = Employee::whereHas('user', function($query){ $query->where('user_id',Auth()->user()->id_user); })->first();

        $this->transaction->id_transaction = "jwl".$date->year.$date->month.$date->day.$date->hour.$date->minute.$date->second;
        $this->transaction->customer_id = $customer_data->id_customer;
        $this->transaction->employee_id = (Auth()->user()->role->role_name == "owner") ? 0 : $employee_data->id_employee;
        $this->transaction->transaction_timestamp = $date;
        $this->transaction->save();
    }

    function saveCustomer(Request $request)
    {
        $this->customer->id_customer = \Str::random();
        $this->customer->customer_name = $request->customer_name;
        $this->customer->customer_contact = $request->customer_contact;
        $this->customer->customer_license_plate = $request->customer_license_plate;
        $this->customer->save();
    }
}