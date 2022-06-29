<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, ProductPromo, Transaction, Customer, User, ProductCategory, VehicleType, TransactionDetail, WorkDetail, Product, Inventory, Config};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Alert;
use Cart;

class TransactionController extends Controller
{
    function __construct()
    {
        $config = Config::first();
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
        $transaction_data = Transaction::with('customer','employee')->get();
        return view('transaction.index',compact('transaction_data','customer_data'));
    }
    
    function transactionJson(Request $request)
    {
        if($request->ajax()){
            if(!empty($request->status)){
                $transaction_data = $this->transaction->with('customer','employee')
                ->where('transaction_status',$request->status)
                ->get();
            } else {
                $transaction_data = $this->transaction->with('customer','employee')->get();
            }
            return DataTables::of($transaction_data)
            ->addColumn('customer',function (Transaction $transaction){
                return $transaction->customer->customer_name;
            })
            ->editColumn('transaction_time', function(Transaction $transaction){
                return $transaction->created_at ? with(new Carbon($transaction->created_at))->isoFormat('HH:mm')/*->diffForHumans()*/ : '';
            })
            ->editColumn('transaction_status', function(Transaction $transaction){
                return $transaction->transaction_status == "pending" 
                    ? "<span class='p-1 rounded bg-warning'>".$transaction->transaction_status."</span>"
                    : "<span class='p-1 rounded bg-success'>".$transaction->transaction_status."</span>" ;
            })
            ->editColumn('transaction_date', function(Transaction $transaction){
                return $transaction->created_at ? with(new Carbon($transaction->created_at))->isoFormat('dddd, D MMMM Y')/*->diffForHumans()*/ : '';
            })
            ->editColumn('action', function(Transaction $transaction){
                return '<a href="/transaction/'.$transaction->id_transaction.'/select-product" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</a> 
                <a href="/transaction/delete/'.$transaction->id_transaction.'" class="btn btn-info receiptButton" id="receiptButton"><i class="fas fa-receipt"></i> Struk</a>
                <a href="/transaction/delete/'.$transaction->id_transaction.'" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a>';
            })
            ->rawColumns(['action','transaction_status'])
            ->addIndexColumn()
            ->toJson();
        }
    }
    
    function checkout($id_transaction)
    {
        $total = 0;
        $employee_data = Employee::get(); 
        $transaction_data = $this->transaction->with('customer','employee')->find($id_transaction);
        $transactionWhereHas_data = $this->transactionDetail->whereHas('transaction', function($query){ 
            $query->where('transaction_id',request()->route('id_transaction')); 
        })->get();
        $productCategory_data =  $this->productCategory->with('productType')->get();
        // $getTotal = $this->getTransactionTotal($id_transaction);
        
        return view('transaction.transaction',compact('employee_data','transaction_data','productCategory_data','transactionWhereHas_data','total'));
    }
    
    # get customer's data to store in transcation
    function createCustomerAndTransactionWithExistingCustomerData(Request $request)
    {
        // get data with spesific id 
        DB::transaction(function() use ($request){
            //get existing customer data
            $customer_data = $this->customer->find($request->id_customer);
            
            // Create transaction data
            $this->saveTransaction($request->id_customer);
        });
        return redirect()->to('transaction/'.$this->transaction->id_transaction.'/select-product');
    }
    
    function createCustomerAndTransactionWithNewCustomerData(Request $request)
    {
        // $customer_data = $request->validate([
        //     'customer_license_plate' => ['unique:customers'],
        // ]);
        $customer_data = Customer::where('customer_license_plate',$request->customer_license_plate)->first();
        // $customer_data = Customer::find($request->id_customer);
        // dd($request->id_customer);
        DB::transaction(function() use ($request,$customer_data){
            if($customer_data == NULL){
                // Create customer data
                $this->saveCustomer($request);
                $this->saveTransaction($this->customer->id_customer);
            } else {
                // Create transaction data
                $this->saveTransaction($request->id_customer);
            }
            
        });
        return redirect()->to('transaction/'.$this->transaction->id_transaction.'/select-product');
        
    }
    
    function saveTransaction($id_customer)
    {
        //generate transaction's id
        $idTransaction = $this->generateTransactionId();
        
        $customer_data = $this->customer->find($id_customer);
        
        // get cashier's data to store in transcation
        $employee_data = Employee::whereHas('user', function($query){ $query->where('user_id',Auth()->user()->id_user); })->first();
        
        $this->transaction->id_transaction = $idTransaction;
        $this->transaction->customer_id = $customer_data->id_customer;
        $this->transaction->employee_id = (Auth()->user()->role->role_name == "owner") ? "owner" : $employee_data->id_employee;
        $this->transaction->transaction_date = date('Y-m-d');
        $this->transaction->save();
    }
    
    function generateTransactionId()
    {
        $date = Carbon::now();
        return "JWL".$date->year.$date->month.$date->day.$date->hour.$date->minute.$date->second;
    }
    
    function storeTransactionDetail(Request $request)
    {
        $employee_data = $request->input('employee_id'); // get employee data who work in a transaction
        $product_data = $this->product->with('productCategory')->find($request->product_id);
        $productType = $product_data->productCategory->productType->product_type;
        
        //get ProductPromo data
        $productPromo_data = ProductPromo::where('product_id',$request->product_id)->first();
        $cutPrice = ($productPromo_data->discount / 100) * $product_data->product_price;
        // $discountPrice = $product_data->product_price - $cutPrice;
        // dd($product_data->product_price - $cutPrice);
        //define id
        $idTransaction = $request->transaction_id;
        $idTransactionDetail = $request->id_transaction_detail;
        $config_data = Config::first();
        //check are product or service
        if($productType === "produk")
        {
            //using cart
            $cart = session()->get($idTransaction,[]);
            
            // if($productPromo_data->product_id == $request->product_id){
            $cart[$idTransactionDetail] = [
                "id_transaction_detail" => $request->id_transaction_detail,
                "product_id" => $request->product_id,
                "product_category_id" => $product_data->productCategory->id_product_category,
                "product_price" => ($productPromo_data == NULL) ? $product_data->product_price : $product_data->product_price - $cutPrice,
                "transaction_detail_amount" => $request->transaction_detail_amount,
                "transaction_detail_total" => ($productPromo_data == NULL) ? $product_data->product_price * $request->transaction_detail_amount  :  $request->transaction_detail_amount * ($product_data->product_price - $cutPrice),
                "transaction_id" => $idTransaction,
                "product_name" => $product_data->product_name,
                "product_type" => $productType,
            ];

            //put on the session
            session()->put($idTransaction,$cart);
        } else {
            //get commission for employee    
            $commission = (($config_data->commission_percentage/100) * $product_data->product_price);
            
            $cart = session()->get($idTransaction,[]);
            
            $cart[$idTransactionDetail] = [
                "id_transaction_detail" => $request->id_transaction_detail,
                "product_id" => $request->product_id,
                "product_category_id" => $product_data->productCategory->id_product_category,
                "product_price" => ($productPromo_data == NULL) ? $product_data->product_price : $product_data->product_price - $cutPrice,
                "transaction_detail_amount" => $request->transaction_detail_amount,
                "transaction_detail_total" => ($productPromo_data == NULL) ? $product_data->product_price * $request->transaction_detail_amount  :  $request->transaction_detail_amount * ($product_data->product_price - $cutPrice),
                "transaction_id" => $idTransaction,
                "product_name" => $product_data->product_name,
                "product_type" => $productType,
            ];
            
            //put on the session
            session()->put($idTransaction,$cart);
            
            DB::transaction(function() use ($employee_data,$request,$product_data,$commission){   
                // save employee data (siapa aja yang nyuci)
                for ($i=0; $i < sizeof($employee_data); $i++) {
                    $this->workDetail->employee_id = $employee_data[$i];
                    $this->workDetail->transaction_detail_id = $request->id_transaction_detail;
                    $this->workDetail->commission = $commission;
                    $this->workDetail->date = Carbon::today();
                    $this->workDetail->save();
                }
                // subtract inventory_data
                foreach($product_data->inventories as $inventory)
                {
                    $this->inventorySubtract($inventory->inventory_name);
                }
            });
        }   
        
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
    
    
    function deleteTransactionDetail($id_transaction, $id_transaction_detail)
    {
        $workDetail_data = $this->workDetail->where('transaction_detail_id',request()->route('id_transaction_detail'))->get();
            
        $cart = session()->get($id_transaction);
            
            //get product data
        $product_data = Product::with('productCategory')->find(
            $cart[$id_transaction_detail]['product_id']
        );
          
            //check if data is product
        if($cart[$id_transaction_detail]['product_type'] == "produk"){
            if(isset($cart[$id_transaction_detail])){
                unset($cart[$id_transaction_detail]);
                session()->put($id_transaction,$cart);
            }
        } else {
            if(isset($cart[$id_transaction_detail])){
                unset($cart[$id_transaction_detail]);
                session()->put($id_transaction,$cart);
            }

            //delete work detail (pekerjaan karyawan)
            DB::transaction(function() use ($id_transaction_detail, $id_transaction, $workDetail_data){
                $transactionDetail_data = TransactionDetail::with('product','productCategory')->find($id_transaction_detail);
                $isProduct = $transactionDetail_data->productCategory->productType->product_type == "produk";
                //if produk
                if($isProduct) {
                    foreach($product_data->inventories as $inventory)
                    {    
                        $inventory_data = Inventory::find($inventory->id_inventory);
                        $inventory_data->inventory_usage += 1;
                        $inventory_data->save();
                    }
                } else {
                    //if service
                    foreach ($workDetail_data as $workDetail) {
                        $selectedWorkDetail = WorkDetail::find($workDetail->id_work_detail);
                        $selectedWorkDetail->delete();
                    }
                }
            });
        }        
        Alert::success('Sukses','Data Transaksi Produk berhasil dihapus');
        return redirect()->back();
    }
        
        function processTransaction($id_transaction)
        {
            DB::transaction(function() use ($id_transaction){
                //get transaction detail data from session
                $cart = session()->get($id_transaction);
                
                //store data to database
                foreach (session($id_transaction) as $transactionDetail) {
                    //make sure transaction detail data is equal to stored data in session
                    if ($transactionDetail['transaction_id'] === $id_transaction) {
                        
                        //if produk
                        if($transactionDetail['product_type'] == "produk"){
                            TransactionDetail::insert([
                                'id_transaction_detail' => $transactionDetail['id_transaction_detail'],
                                'product_id' => $transactionDetail['product_id'],
                                'product_category_id' =>$transactionDetail['product_category_id'],
                                'transaction_detail_amount' => $transactionDetail['transaction_detail_amount'],
                                'transaction_detail_total' => $transactionDetail['transaction_detail_total'],
                                'transaction_id' => $transactionDetail['transaction_id'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                            
                            /* subtract product stock */
                            $this->subtractProductStock(
                                $transactionDetail['product_id'],
                                $transactionDetail['transaction_detail_amount']
                            );
                        } else {
                            //if servis
                            TransactionDetail::insert([
                                'id_transaction_detail' => $transactionDetail['id_transaction_detail'],
                                'product_id' => $transactionDetail['product_id'],
                                'product_category_id' =>$transactionDetail['product_category_id'],
                                'transaction_detail_amount' => $transactionDetail['transaction_detail_amount'],
                                'transaction_detail_total' => $transactionDetail['transaction_detail_total'],
                                'transaction_id' => $transactionDetail['transaction_id'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }   
                }
                //unset session data after store data in database
                session()->forget($id_transaction);
                
                
                //1 update status and grandtotal in transaction
                $commissionTotal = 0;
                $transaction_data = $this->transaction->with('customer','employee')->find($id_transaction);
                $transaction_data->transaction_status = "complete";
                $transaction_data->transaction_grandtotal = $this->getTransactionTotal($id_transaction);
                $transaction_data->save();
            });
            
            Alert::success('Sukses','Transaksi complete !');
            return redirect()->to('/transaction');
        }
        
        function deleteTransaction($id_transaction, Request $request)
        {
            $transactionDetail_data = $this->transactionDetail->where('transaction_id',$request->route('id_transaction'))->first();
            if(!$transactionDetail_data){
                DB::transaction(function() use ($id_transaction, $request){
                    //delete transaction data and its detail transaction
                    $transaction_data = $this->transaction->find($id_transaction);
                    $transaction_data->delete();
                    Alert::success('Sukses','Data Transaksi Pelanggan berhasil dihapus');
                });
            } else {
                Alert::error('Gagal','Hapus detail data transaksinya dahulu !');
            }
            return redirect()->back();
        }
        
        function getTransactionTotal($id_transaction)
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
            $product_data->save();
        }
        
        function saveTransactionDetail($product_id)
        {
            $product_data = $this->product->with('productCategory')->find($product_id);
            $this->transactionDetail->id_transaction_detail = request()->id_transaction_detail;
            $this->transactionDetail->product_id = request()->product_id;
            $this->transactionDetail->transaction_detail_date = date('Y-m-d');
            $this->transactionDetail->transaction_detail_amount = request()->transaction_detail_amount;
            $this->transactionDetail->transaction_detail_total = (request()->transaction_detail_amount * $product_data->product_price); 
            $this->transactionDetail->transaction_id = request()->transaction_id;
            $this->transactionDetail->save();
        }
        
        function saveCustomer(Request $request)
        {
            $this->customer->id_customer = \Str::random();
            $this->customer->customer_name = ($request->customer_name != null) ? $request->customer_name : "pelanggan anonim" ;
            $this->customer->customer_contact = ($request->customer_contact != null) ? $request->customer_contact : "-";
            $this->customer->customer_license_plate = $request->customer_license_plate;
            $this->customer->customer_vehicle = $request->customer_vehicle;
            $this->customer->customer_attend += 1;
            $this->customer->save();
        }
        
        function dropdownProduct(Request $request)
        {
            $product_data = $this->product->select(['product_name','id_product','product_category_id','product_price'])
            ->where('product_category_id',$request->id)
            ->where('is_active','1')
            ->get();
            return response()->json($product_data);
        }
        
        function getProductProduct(Request $request)
        {
            $product_data = $this->product->select(['product_name','id_product','product_price'])
            ->find($request->id);
            return response()->json($product_data);
        }
        
        function getCustomerData()
        {
            // $customer_data = Customer::where('customer_license_plate','LIKE','%'.request()->input("customer_license_plate").'%')
            //     ->take(10)
            //     ->get();
            $customer_data = Customer::where('customer_license_plate',request()->customer_license_plate)->first();
            $data = [
                'id_customer' => $customer_data->id_customer,
                'customer_license_plate' => $customer_data->customer_license_plate,
                'customer_name' => $customer_data->customer_name,
                'customer_contact' => $customer_data->customer_contact,
                'customer_vehicle' => $customer_data->customer_vehicle,
            ];
            return json_encode($data);
        }
        
    function getPlateData()
    {
        $customer_data = Customer::select('customer_license_plate')->where('customer_license_plate','LIKE','%'.request()->input("customer_license_plate").'%')
            ->take(10)
            ->get();
        // $customer_data = Customer::select('customer_license_plate')->where('customer_license_plate',request()->customer_license_plate)->first();
        // $data = [
        //     'customer_license_plate' => $customer_data->customer_license_plate,
        //     'customer_name' => $customer_data->customer_name,
        //     'customer_contact' => $customer_data->customer_contact,
        //     'customer_vehicle' => $customer_data->customer_vehicle,
        // ];
        return response()->json($customer_data);
    }

    function printStruck($id_transaction)
    {
        $transaction_data = Transaction::find($id_transaction);
        $config_data = Config::first();
        $transactionDetail_data = $this->transactionDetail->whereHas('transaction', function($query){ 
            $query->where('transaction_id',request()->route('id_transaction')); 
        })->get();
        // dd($transactionDetail_data);
        // dd($transaction_data);
        $this->processTransaction($id_transaction);
        // try {
        //     // Enter the share name for your USB printer here
        //     // $connector = null;
        //     // $connector = new WindowsPrintConnector("POS-58-1");
        //     // // $connector = new FilePrintConnector("");
        
        //     // /* Print a "Hello world" receipt" */
        //     // $printer = new Printer($connector);
        //     // $printer->initialize();
        //     // $printer->setFont(Printer::FONT_A);
        //     // $printer->setJustification(Printer::JUSTIFY_CENTER);
        //     // $printer->text($config_data->carwash_name."\n");
        //     // $printer->setLineSpacing(2);

        //     // $printer->initialize();
        //     // $printer->setFont(Printer::FONT_A);
        //     // $printer->setJustification(Printer::JUSTIFY_CENTER);
        //     // $printer->text($config_data->carwash_address."\n");
        //     // $printer->setLineSpacing(2);

        //     // $printer->text("-----------------------------"."\n");
        //     // $printer->initialize();
        //     // $printer->setFont(Printer::FONT_A);
        //     // $printer->setJustification(Printer::JUSTIFY_LEFT);
        //     // $printer->text("Kode Transaksi : ".$transaction_data->id_transaction."\n");
        //     // $printer->setLineSpacing(2);

        //     $printer->initialize();
        //     $printer->setFont(Printer::FONT_A);
        //     $printer->setJustification(Printer::JUSTIFY_LEFT);
        //     $printer->text("Nama Pelanggan : ".$transaction_data->customer->customer_name."\n");
        //     $printer->setLineSpacing(2);
        //     foreach ($transactionDetail_data as $transactionDetail) {
        //         # code...
        //         $printer->text($transactionDetail->product->product_name);
        //         $printer->text("\n"); 
        //         $printer->text($transactionDetail->product_price." x ".$transactionDetail->transaction_detail_amount);
        //         $printer->text("                      ");
        //         $printer->text($transactionDetail->transaction_detail_total);
        //     }
        //     // $line = sprintf('%-13.40s %3.0f %-3.40s %9.40s %-2.40s %13.40s'); $printer->initialize();
        //     $printer->setFont(Printer::FONT_A);
        //     $printer->setJustification(Printer::JUSTIFY_LEFT);
        //     $printer->text("===================================");
        //     $printer->setLineSpacing(2);
            
        //     $printer->setFont(Printer::FONT_A);
        //     $printer->setJustification(Printer::JUSTIFY_RIGHT);
        //     $printer->text("Grand Total".$transaction_data->transaction_grandtotal);
        //     $printer->setLineSpacing(2);

        //     $printer->setFont(Printer::FONT_A);
        //     $printer->setJustification(Printer::JUSTIFY_CENTER);
        //     $printer->text("Terima Kasih :)");
        //     $printer->setLineSpacing(2);

        //     // end loop
        //     $printer -> cut();
        //     $printer -> close();
            
        //     /* Close printer */
        //     // $printer -> close();
        // } catch (Exception $e) {
        //     echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        // }
        return redirect()->to('transaction');
    }
}
