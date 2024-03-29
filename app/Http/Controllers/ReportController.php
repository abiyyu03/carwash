<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transaction, Product,ProductCategory,WorkDetail, TransactionDetail, Customer, Employee, InventoryDetail, Outcome, AttendanceStart, AttendanceLeave, AttendanceSchedule, AttendanceStatus, Config};
use Illuminate\Support\Facades\DB;
use Alert;
use PDF;
use Lava;
use Carbon\Carbon;
use DataTables;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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
        // $getTransactionTotal = $this->getTransactionTotal();
        $transactionPending_count = Transaction::where('transaction_status','pending')->count();
        $transactionComplete_count = Transaction::where('transaction_status','complete')->count();
        $transactionTotal = Transaction::sum('transaction_grandtotal');

        //if in range date filter
        if(request()->ajax()){
            if(!empty(request()->from_date)){    
                $transaction_data = Transaction::with('employee','customer')
                    ->whereBetween('transaction_date',[request()->from_date,request()->to_date])
                    ->where('transaction_status',"=","complete")
                    ->get();
            } else {
                $transaction_data = Transaction::with('employee','customer')
                    ->where('transaction_status',"=","complete")
                    // ->where('transaction_date',date('Y-m-d'))
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
                    return ($transaction->employee == NULL) ? "Owner" : $transaction->employee->employee_fullname;
                })
                ->addColumn('customer_name',function (Transaction $transaction){
                    return $transaction->customer->customer_name;
                })
                ->addColumn('customer_license_plate',function (Transaction $transaction){
                    return $transaction->customer->customer_license_plate;
                })
                ->toJson();
        }
        return view('report.daily.daily',compact('transactionPending_count','transactionComplete_count','transactionTotal'));
    }

    function allCategoryReport()
    {
        $getTransactionTotal =  Transaction::where('transaction_status','complete')->sum('transaction_grandtotal');
        if (request()->ajax()) {
            if(!empty(request()->from_date)){
                $transactionDetail_data = TransactionDetail::with('product','transaction')
                    ->groupBy('product_category_id')
                    ->selectRaw('product_category_id, sum(transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('product_category_id, sum(transaction_detail_amount) as transaction_detail_amount')
                    ->whereBetween('transaction_detail_date',[request()->from_date,request()->to_date])
                    ->get();
                    // $chart = TransactionDetail::with('product','transaction')
                    //     ->selectRaw('DATE(transaction_detail_date) as date')
                    //     ->selectRaw('transaction_detail_amount as amount')
                    //     ->whereBetween('transaction_detail_date',[request()->from_date,request()->to_date])
                    //     ->where('')
                    //     ->pluck('amount','date');
            } else {
                $transactionDetail_data = TransactionDetail::with('product','transaction')
                    ->groupBy('product_category_id')
                    ->selectRaw('product_category_id, sum(transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('product_category_id, sum(transaction_detail_amount) as transaction_detail_amount')
                    ->get();
            }
            
            return DataTables()->of($transactionDetail_data)
            ->addIndexColumn()
            ->editColumn('category_name',function (TransactionDetail $transactionDetail_data){
                return $transactionDetail_data->productCategory->category_name;
            })
            ->editColumn('transaction_detail_total',function (TransactionDetail $transactionDetail_data){
                return $transactionDetail_data->transaction_detail_total;
            })
            ->toJson();
        }
        
        return view('report.all-category',compact('getTransactionTotal'));
    }

    function summaryReport()
    {
        // $outcome_data = Outcome::sum('expense_balance');

        if(request()->ajax())
        {
            if(!empty(request()->from_date))
            {
                //income data
                $transactionDetailProduk_total = 0; 
                $transactionDetailServis_total = 0; 
                $transactionDetail = TransactionDetail::with('product')
                ->whereBetween('transaction_detail_date',[request()->from_date,request()->to_date])
                    // ->whereBetween('transaction_detail_date',["2022-06-21","2022-06-21"])
                    ->get();
                foreach ($transactionDetail as $value) {
                    if($value->product->productCategory->productType->product_type == "produk")
                    {
                        $transactionDetailProduk_total += 1;
                    } else {
                        $transactionDetailServis_total += 1;
                    }
                }
                
                //outcome data
                $fixCost = 0;
                $variableCost = 0;
                $allTypeCost = 0;
                $outcome_data = Outcome::whereBetween('outcome_date',[request()->from_date,request()->to_date])->get();
                foreach ($outcome_data as $value) {
                    if($value->outcomeType->outcome_type == "fix_cost")
                    {
                        $fixCost += $value->expense_balance;
                    }else {
                        $variableCost += $value->expense_balance;
                    }
                    $allTypeCost += $value->expense_balance;
                }
                $transactionDetail_total = TransactionDetail::whereBetween('transaction_detail_date',[request()->from_date,request()->to_date])->sum('transaction_detail_total');
                $workDetail_commission = WorkDetail::whereDate('created_at', '>=', request()->from_date)->whereDate('created_at', '<=',request()->to_date)->sum('commission');
                $customer = Customer::whereDate('created_at', '>=', request()->from_date)->whereDate('created_at', '<=', request()->to_date)->count();
                $employee = new Employee();
                $attendance = AttendanceStatus::with('attendanceStart','attendanceLeave','attendanceSchedule','employee');
                $attendance_attend = $attendance->where('attendance_status','attend')->whereDate('created_at', '>=', request()->from_date)->whereDate('created_at', '<=', request()->to_date)->count();
                // dd($attendance_attend);
                $attendance_present = $employee->count() - $attendance_attend;

                $data = [
                    'fixCost' => $fixCost,
                    'variableCost' =>$variableCost,
                    'customer' => $customer,
                    'transactionDetailProduk_total' => $transactionDetailProduk_total,
                    'transactionDetailServis_total' => $transactionDetailServis_total,
                    'attendance_present' => $attendance_present,
                    'attendance_attend' => $attendance_attend,
                    'customer' => $customer,
                    'transactionDetail_total' => $transactionDetail_total,
                    'allTypeCost' => $allTypeCost,
                    'workDetail_commission' => $workDetail_commission
                ];
            } else {
                $transactionDetailProduk_total = 0; 
                $transactionDetailServis_total = 0; 
                $transactionDetail = TransactionDetail::with('product')->get();
                foreach ($transactionDetail as $value) {
                    if($value->product->productCategory->productType->product_type == "produk")
                    {
                        $transactionDetailProduk_total += 1;
                    } else {
                        $transactionDetailServis_total += 1;
                    }
                }

                //count outcome
                $fixCost = 0;
                $variableCost = 0;
                $allTypeCost = 0;
                $outcome_data = Outcome::get();
                foreach ($outcome_data as $value) {
                    if($value->outcomeType->outcome_type == "fix_cost")
                    {
                        $fixCost += $value->expense_balance;
                    }else {
                        $variableCost += $value->expense_balance;
                    }
                    $allTypeCost += $value->expense_balance;
                }

                $transactionDetail_total = TransactionDetail::sum('transaction_detail_total');
                $workDetail_commission = WorkDetail::sum('commission');
                $customer = Customer::count();
                $employee = new Employee();
                $attendance = AttendanceStatus::with('attendanceStart','attendanceLeave','attendanceSchedule','employee');
                $attendance_attend = $attendance->where('attendance_status','attend')->count();
                $attendance_present = $employee->count() - $attendance->where('attendance_status','attend')->count();

                $inventoryDetail_data = InventoryDetail::selectRaw('sum(inventory_detail_price) as inventory_detail_price')->first();
                // $getTransactionTotal = $this->getTransactionTotal();
                // $soldProduct = $this->soldProduct();
                $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))
                    ->groupBy('product_id')
                    ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('sum(transaction_detail_amount) as transaction_detail_amount')
                    ->get();
                // dd($transactionDetail_data);
                $data = [
                    'fixCost' => $fixCost,
                    'variableCost' =>$variableCost,
                    'customer' => $customer,
                    'transactionDetailProduk_total' => $transactionDetailProduk_total,
                    'transactionDetailServis_total' => $transactionDetailServis_total,
                    'attendance_present' => $attendance_present,
                    'attendance_attend' => $attendance_attend,
                    'customer' => $customer,
                    'transactionDetail_total' => $transactionDetail_total,
                    'allTypeCost' => $allTypeCost,
                    'workDetail_commission' => $workDetail_commission
                ];
            }
        

            return json_encode($data);
        }
        // ,compact('transactionDetail_data','customer',
        // 'transactionDetailProduk_total','transactionDetailServis_total','attendance_attend',
        // 'attendance_present','fixCost','variableCost','allTypeCost','transactionDetail_total','workDetail_commission')
        return view('report.daily.summary');
    }

    function reportAllProductJson()
    {
        
        // return $getTransactionTotal;
        // $transactionDetail_data = TransactionDetail::whereHas('transaction', function($query){ 
        //     $query->where('transaction_status','success'); 
        // })->get();
        // $transaction_data = Transaction::where('transaction_status','complete')->get();
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
                $transactionDetail_data = TransactionDetail::with('product','transaction')
                    ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                    ->selectRaw('product_id, sum(transaction_detail_amount) as transaction_detail_amount')
                    ->groupByRaw('product_id')
                    // ->where('transaction.transaction_status','complete')
                    ->get();
                // $transactionDetail_data = DB::table('products')
                //     ->join('transaction_details', 'transaction_details.product_id', '=', 'products.id_product','left outer')
                //     ->selectRaw('product_name as product_name')
                //     // ->selectRaw('transaction_details.transaction_detail_date as transaction_detail_date')
                //     ->selectRaw('sum(transaction_details.transaction_detail_total) as transaction_detail_total')
                //     ->selectRaw('sum(transaction_details.transaction_detail_amount) as transaction_detail_amount')
                //     ->groupBy('products.product_name')
                //     ->get();
                }    
                return DataTables()->of($transactionDetail_data)
                    ->addIndexColumn()
                    // ->with('transaction_data')
                    ->editColumn('product_name',function (TransactionDetail $transactionDetail_data){
                        return $transactionDetail_data->product->product_name;
                    })
                    ->editColumn('transaction_detail_total',function (TransactionDetail $transactionDetail_data){
                        return $transactionDetail_data->transaction_detail_total;
                    })
                    ->toJson();
            }
        
    }
    function reportAllProduct()
    {
        $transactionDetail_data = TransactionDetail::groupBy('product_id')
            ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
            ->selectRaw('sum(transaction_detail_amount) as transaction_detail_amount')
            ->get();
        // dd($transactionDetail_data);
        $chart = Lava::DataTable();
        $chart->addStringColumn('Day of Month')
            ->addNumberColumn('Produk');

        // Random Data For Example
        $a = 1;
        foreach ($transactionDetail_data as $transactionDetail) {
            $chart->addRow([
                $transactionDetail->product->product_name, $transactionDetail->transaction_detail_amount
            ]);
            $a++;
        }
        Lava::LineChart('MyStocks', $chart,
        ['events' => [
            'select' => 'selectCallback'
        ]
        ]);
        
        // dd($transactionDetail_data);
        // $transactionDetail_count = $transactionDetail_data->sum('transaction_detail_amount');
        $getTransactionTotal = Transaction::where('transaction_status','complete')->sum('transaction_grandtotal');
        $transactionDetailProduk_total = 0; 
        $transactionDetailServis_total = 0; 
        $transactionDetail = TransactionDetail::with('product')->get();
        foreach ($transactionDetail as $value) {
            if($value->product->productCategory->productType->product_type == "produk")
            {
                $transactionDetailProduk_total += 1;
            } else {
                $transactionDetailServis_total += 1;
            }
        }
        $transactionDetailProduk_total = 0; 
        $transactionDetailServis_total = 0; 
        $transactionDetail = TransactionDetail::with('product')->get();
        foreach ($transactionDetail as $value) {
            if($value->product->productCategory->productType->product_type == "produk")
            {
                $transactionDetailProduk_total += 1;
            } else {
                $transactionDetailServis_total += 1;
            }
        }
        $transactionDetail_count = TransactionDetail::sum('transaction_detail_amount');
        $transactionDetail_total = TransactionDetail::sum('transaction_detail_total');
        $productCategory_data = ProductCategory::get();
        return view('report.all-product',compact('getTransactionTotal','transactionDetail_count',
                'transactionDetail_total','transactionDetailProduk_total','transactionDetailServis_total'));
    }

    function exportAllProductPDF()
    {
        $config_data = Config::first();
        $data = json_decode(json_encode($this->reportAllProductJson()),true);
        $allProduct_data = $data['original']['data'];
        $pdf = PDF::loadView('report.export.all-product-pdf',compact('allProduct_data','config_data'))
            ->setOptions(['defaultFont' => 'sans-serif']);
            // ->setPaper('a4', 'landscape');
        return $pdf->stream();
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

    function exportSummaryPDF()
    {
        $transactionDetailProduk_total = 0; 
        $transactionDetailServis_total = 0; 
        $transactionDetail = TransactionDetail::with('product')->get();
        foreach ($transactionDetail as $value) {
            if($value->product->productCategory->productType->product_type == "produk")
            {
                $transactionDetailProduk_total += 1;
            } else {
                $transactionDetailServis_total += 1;
            }
        }

        //count outcome
        $fixCost = 0;
        $variableCost = 0;
        $allTypeCost = 0;
        $outcome_data = Outcome::get();
        foreach ($outcome_data as $value) {
            if($value->outcomeType->outcome_type == "fix_cost")
            {
                $fixCost += $value->expense_balance;
            }else {
                $variableCost += $value->expense_balance;
            }
            $allTypeCost += $value->expense_balance;
        }

        $transactionDetail_total = TransactionDetail::sum('transaction_detail_total');
        $workDetail_commission = WorkDetail::sum('commission');
        $customer = Customer::count();
        $employee = new Employee();
        $attendance = AttendanceStatus::with('attendanceStart','attendanceLeave','attendanceSchedule','employee');
        $attendance_attend = $attendance->where('attendance_status','attend')->count();
        $attendance_present = $employee->count() - $attendance->where('attendance_status','attend')->count();

        $inventoryDetail_data = InventoryDetail::selectRaw('sum(inventory_detail_price) as inventory_detail_price')->first();
        // $getTransactionTotal = $this->getTransactionTotal();
        // $soldProduct = $this->soldProduct();
        $transactionDetail_data = TransactionDetail::where("transaction_detail_date",date('Y-m-d'))
                ->groupBy('product_id')
                ->selectRaw('product_id, sum(transaction_detail_total) as transaction_detail_total')
                ->selectRaw('sum(transaction_detail_amount) as transaction_detail_amount')
                ->get();
        $pdf = PDF::loadView('report.export.summary-pdf', compact('transactionDetail_data','customer',
        'transactionDetailProduk_total','transactionDetailServis_total','attendance_attend',
        'attendance_present','fixCost','variableCost','allTypeCost','transactionDetail_total','workDetail_commission'))
            ->setOptions(['defaultFont' => 'sans-serif'])
            ->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    function dropdownCategoryData()
    {

    }
}