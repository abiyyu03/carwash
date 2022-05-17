<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, Transaction, Customer, User, ProductCategory, VehicleType, TransactionDetail, WorkDetail, Product, Inventory};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Alert;

class TransactionController extends Controller
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

    function index()
    {
        $customer_data = $this->customer->get();
        $transaction_data = $this->transaction->with('customer','employee')->get();
        return view('transaction.index',compact('transaction_data','customer_data'));
    }

    function transactionJson(Request $request)
    {
        if($request->ajax()){
            return Datatables::eloquent($this->transaction->with('customer','employee'))
                ->addColumn('customer',function (Transaction $transaction){
                    return $transaction->customer->customer_name;
                })
                ->editColumn('transaction_timestamp', function(Transaction $transaction){
                    return $transaction->transaction_timestamp ? with(new Carbon($transaction->transaction_timestamp))->isoFormat('dddd, D MMMM Y || HH:mm')/*->diffForHumans()*/ : '';
                })
                ->addIndexColumn()
                ->toJson();
        }
    }

    function checkout($id_transaction)
    {
        $employee_data = Employee::get(); 
        $transaction_data = $this->transaction->with('customer','employee')->find($id_transaction);
        $transactionWhereHas_data = $this->transactionDetail->whereHas('transaction', function($query){ $query->where('transaction_id',request()->route('id_transaction')); })->get();
        $productCategory_data =  $this->productCategory->with('productType')->get();
        $getTotal = $this->getTotal($id_transaction);

        return view('transaction.transaction',compact('employee_data','transaction_data','productCategory_data','transactionWhereHas_data','getTotal'));
    }

    # get customer's data to store in transcation
    function createCustomerAndTransactionWithExistingCustomerData(Request $request)
    {
        // get data with spesific id 
        $customer_data = $this->customer->find($request->id_customer);
        
        $employee_data = Employee::whereHas('user', function($query){ 
            $query->where('user_id',Auth()->user()->id_user); 
        })->first();
        // $employee_data = Employee::with('user')->where('user_id',Auth()->user()->id_user)->find();
        // dd($employee_data->id_employee);

        $this->transaction->id_transaction = rand(); //\Str::random();
        $this->transaction->customer_id = $customer_data->id_customer;
        $this->transaction->employee_id = (Auth()->user()->role->role_name == "owner") ? 0 : $employee_data->id_employee;
        $this->transaction->transaction_timestamp = Carbon::now();
        $this->transaction->save();

        return redirect()->to('transaction/'.$this->transaction->id_transaction.'/selectProduct');
    }

    function createCustomerAndTransactionWithNewCustomerData(Request $request)
    {
        $customer_data = $request->validate([
            'customer_name' => ['required'],
            'customer_contact' => ['required'],
            'customer_license_plate' => ['required','unique:customers'], //and unique:customer
        ]);

        DB::transaction(function() use ($request){
            // Create customer data
            $this->customer->id_customer = rand();
            $this->customer->customer_name = $request->customer_name;
            $this->customer->customer_contact = $request->customer_contact;
            $this->customer->customer_license_plate = $request->customer_license_plate;
            $this->customer->save();

            // get cashier's data to store in transcation
            $employee_data = Employee::whereHas('user', function($query){ 
                $query->where('user_id',Auth()->user()->id_user); 
            })->first();

            $this->transaction->id_transaction = rand(); //\Str::random();
            $this->transaction->customer_id = $this->customer->id_customer;
            $this->transaction->employee_id = (Auth()->user()->role->role_name == "owner") ? 0 : $employee_data->id_employee ;
            $this->transaction->transaction_timestamp = Carbon::now();
            $this->transaction->save();

        });
        return redirect()->to('transaction/'.$this->transaction->id_transaction.'/selectProduct');
        
    }
    
    function storeTransactionDetail(Request $request)
    {
        $employee_data = $request->input('employee_id'); // get employee data who work in a transaction
        $productCategory_data =  $this->productCategory->with('productType')->find($request->product_category_id);
        $product_data =$this->product->with('productCategory')->find($request->product_id);
        
        DB::transaction(function() use ($employee_data,$request,$productCategory_data,$product_data){
            //check are product or service
            if($productCategory_data->productType->product_type == "produk")
            {
                $this->transactionDetail->id_transaction_detail = rand();
                $this->transactionDetail->product_id = $request->product_id;
                // $this->transactionDetail->transaction_detail_price = $product_data->product_price;
                $this->transactionDetail->transaction_detail_amount = $request->transaction_detail_amount;
                $this->transactionDetail->transaction_detail_total = ($request->transaction_detail_amount  * $product_data->product_price); 
                $this->transactionDetail->transaction_id = $request->transaction_id;
                $this->transactionDetail->save();
                
                //subtract (kurangi) product's stock
                // $this->subtractProductStock($transactionDetail_data->product_id, $transactionDetail_data->transaction_detail_amount);
            } else {
                $this->transactionDetail->id_transaction_detail = rand();
                $this->transactionDetail->product_id = $request->product_id;
                // $this->transactionDetail->transaction_detail_price = $product_data->product_price;
                $this->transactionDetail->transaction_detail_amount = $request->transaction_detail_amount;
                $this->transactionDetail->transaction_detail_total = ($request->transaction_detail_amount * $product_data->product_price); 
                $this->transactionDetail->transaction_id = $request->transaction_id;
                $this->transactionDetail->save();
                
                $commission = ((40/100) * $product_data->product_price);
                // $tax = 10/100;
                
                // save employee data (siapa aja yang nyuci)
                for ($i=0; $i < sizeof($employee_data); $i++) {
                    $this->workDetail->employee_id = $employee_data[$i];
                    $this->workDetail->transaction_detail_id = $this->transactionDetail->id_transaction_detail;
                    $this->workDetail->commission = $commission;
                    $this->workDetail->date = Carbon::today();
                    $this->workDetail->save();
                }
                // $s[] = Session(['key' => $this->workDetail]);
                //inventory data
                // suggests : save inventorysubtract or productstocksubtract, work detail in temporary 
                $this->inventorySubtract('sampo');
                
                //bisnis proses yang belum : pengurangan inventory, penggajian karyawan (pembagian komisi)
            }   
        });
        //get Total
        // $transaction_data = Transaction::with('customer','employee')->find($request->get('transaction_id'));
        // $transaction_data->transaction_grandtotal = $this->getTotal($request->get('transaction_id'));
        // $transaction_data->save();
        
        Alert::success('Sukses','Data transaksi sukses disimpan');
        return redirect()->back();
    }

    function inventorySubtract($inventory_name)
    {
        $inventory_data = Inventory::select(['id_inventory','inventory_name','inventory_unit','inventory_usable','inventory_usage'])
                    ->where('inventory_name',$inventory_name)->get();

        foreach($inventory_data as $inventory)
        {
            $selectedInventory = Inventory::find($inventory->id_inventory);
            if($selectedInventory->inventory_usage != 0)
            {
                $selectedInventory->inventory_usage -= 1;
            } else {
                $selectedInventory->inventory_usage = $selectedInventory->inventory_usable;
                $selectedInventory->inventory_unit -= 1;
            }
            $selectedInventory->save();
        }
        
    }

    function dropdownProduct(Request $request)
    {
        $product_data = $this->product->select(['product_name','id_product','product_category_id','product_price'])
                    ->where('product_category_id',$request->id)
                    ->get();
        // dd($product_data);
        return response()->json($product_data);
    }

    
    function deleteTransactionDetail($id_transaction_detail)
    {
        $transactionDetail_data = $this->transactionDetail->find($id_transaction_detail);
        $workDetail_data = WorkDetail::whereHas('transactionDetail', function($query){ 
            $query->where('transaction_detail_id',request()->route('id_transaction_detail')); 
        })->get();
        if($transactionDetail_data->product->productCategory->productType->product_type == "produk"){
            $transactionDetail_data->delete();
        } else {
            foreach ($workDetail_data as $workDetail) {
                $selectedWorkDetail = WorkDetail::find($workDetail->id_work_detail);
                $selectedWorkDetail->delete();
            }
            $transactionDetail_data->delete();
        }
        
        // dd($selectedWorkDetail->id_work_detail);
        Alert::success('Sukses','Data Transaksi Produk berhasil dihapus');
        return redirect()->back();
    }

    function processTransaction()
    {
        //complete transaction and print struct
    }

    function deleteTransaction($id_transaction, Request $request)
    {
        $transactionDetailWhereHas_data = $this->transactionDetail->where('transaction_id',$request->route('id_transaction'))->first();
        if(!$transactionDetailWhereHas_data){
            DB::transaction(function() use ($id_transaction, $request){
                //delete transaction data and its detail transaction
                $transaction_data = $this->transaction->find($id_transaction);
                $transaction_data->delete();
            });
        } else {   
            Alert::error('Gagal','Hapus detail data transaksinya dahulu !');
            return redirect()->back();
        }
        Alert::success('Sukses','Data Transaksi Pelanggan berhasil dihapus');
        return redirect()->to('/transaction');
    }

    function getTotal($id_transaction)
    {
        $total = 0;
        $transactionDetail_data = $this->transactionDetail->select(['transaction_id','transaction_detail_total'])->where('transaction_id',$id_transaction)->get();
        foreach ($transactionDetail_data as $transactionDetail) {
            $total += $transactionDetail->transaction_detail_total;
        }
        return $total;
    }
    
    function subtractProductStock($product_id,$transaction_detail_amount)
    {
        $product_data = $this->product->with('productCategory')->find($product_id);
        $product_data->product_stock -= $transaction_detail_amount;
        // $product_data->save();
        return $product_data;
    }
}
