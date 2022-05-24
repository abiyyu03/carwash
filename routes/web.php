<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/dropdownProduct',[TransactionController::class,'dropdownProduct'])->name('dropdownProduct');

//owner only
Route::middleware('owner')->group(function(){
    //user (account)
    Route::get('/account',[UserController::class,'index']);
    Route::get('/userJson',[UserController::class,'userJson'])->name('user.userJson');
    
    //customer
    Route::get('/customer',[CustomerController::class,'index']);
    Route::get('/customerJson',[CustomerController::class,'customerJson'])->name('customer.customerJson');
    Route::get('/customer/delete/{id_customer}',[CustomerController::class,'delete']);
    Route::put('/customer/update/{id_customer}',[CustomerController::class,'update']);
    
    //product category
    Route::get('/product_category',[ProductCategoryController::class,'index']);
    Route::get('/product_categoryJson',[ProductCategoryController::class,'productCategoryJson'])->name('productCategory.productCategoryJson');
    Route::post('/product_category/store',[ProductCategoryController::class,'store'])->name('product_category.store');
    Route::get('/product_category/edit/{id_product_category}',[ProductCategoryController::class,'edit']);
    Route::put('/product_category/update/{id_product_category}',[ProductCategoryController::class,'update'])->name('product_category.update');

    //product 
    Route::get('/product',[ProductController::class,'index']);
    Route::get('/productJson',[ProductController::class,'productJson'])->name('product.productJson');
    Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/product/delete/{id_product}',[ProductController::class,'delete']);
    // Route::get('/product/edit/{id}',[ProductController::class,'edit']);
    Route::put('/product/update/{id_product}',[ProductController::class,'update'])->name('product.update');
    
    //Employee 
    Route::get('/employee',[EmployeeController::class,'index']);
    Route::get('/employeeJson',[EmployeeController::class,'employeeJson'])->name('employee.employeeJson');
    Route::post('/employee/store',[EmployeeController::class,'store'])->name('employee.store');
    Route::get('/employee/delete/{id_employee}',[EmployeeController::class,'delete']);
    Route::get('/employee/commission',[CommissionController::class,'index']);
    Route::get('/employee/count/{id_employee}',[CommissionController::class,'setCommission']);
    Route::get('/employee/commissionJson',[EmployeeController::class,'commissionJson'])->name('commission.commissionJson');
    
    // Attendance
    Route::get('/employee/attendance',[AttendanceController::class,'index']);
    Route::get('/attendanceJson',[AttendanceController::class,'attendanceJson'])->name('attendance.attendanceJson');

    //Inventory
    Route::get('/inventory',[InventoryController::class,'index']);
    Route::get('/inventoryJson',[InventoryController::class,'inventoryJson'])->name('inventory.inventoryJson');
    Route::post('/inventory/store',[InventoryController::class,'store'])->name('inventory.store');
    Route::put('/inventory/update/{id_inventory}',[InventoryController::class,'update'])->name('inventory.update');
    Route::get('/inventory/delete/{id_inventory}',[InventoryController::class,'delete']);
    
    //Report
    Route::get('/report/daily',[ReportController::class,'index']);
    Route::get('/report/monthly',[ReportController::class,'index']);

    //Supplier
    Route::get('/supplier',[SupplierController::class,'index']);
    Route::post('/supplier/store/{Sid_supplier)',[SupplierController::class,'store'])->name('supplier.store');
    Route::get('/supplier/delete/{id_supplier}',[SupplierController::class,'delete']);
    Route::put('/supplier/update/{id_supplier}',[SupplierController::class,'update'])->name('supplier.update');
        
});

Route::middleware('supervisor')->group(function(){
    Route::get('/asdd', function () {
        return 'supervisor';    
    });
});

//cashier and owner
Route::middleware('role: cashier|owner')->group(function(){
    Route::get('/',[DashboardController::class,'index']);

    //transaction
    Route::get('/transaction',[TransactionController::class,'index']);
    Route::get('/transaction/delete/{id_transaction}',[TransactionController::class,'deleteTransaction']);
    Route::get('/transactionJson',[TransactionController::class,'transactionJson'])->name('transaction.transactionJson');
    Route::post('/transaction/checkout/create-new',[TransactionController::class,'createCustomerAndTransactionWithNewCustomerData'])->name('transaction.create');
    Route::post('/transaction/checkout/use-existing',[TransactionController::class,'createCustomerAndTransactionWithExistingCustomerData'])->name('transaction.useExisting');
    
    Route::post('/transaction/detail/store',[TransactionController::class,'storeTransactionDetail'])->name('transaction.storeTransactionDetail');
    Route::get('/transaction/detail/delete/{id_transaction_detail}',[TransactionController::class,'deleteTransactionDetail']);
    Route::get('/transaction/{id_transaction}/select-product',[TransactionController::class,'checkout']);
    Route::get('/transaction/{id_transaction}/finish',[TransactionController::class,'processTransaction']);
    Route::get('/transaction/getTotal/{id_transaction}',[TransactionController::class,'getTotal']);

    // config
    Route::get('/config',[ConfigController::class,'index']);
    Route::put('/config/user-edit/{id_user}',[ConfigController::class,'edit']);
    Route::put('/config/user-update/{id_user}',[ConfigController::class,'update'])->name('user.update');
});

//Auth's route 
Route::get('/login',[Auth\LoginController::class,'login']);
Route::get('/owner/login',[Auth\LoginController::class,'login']);
Route::post('/login',[Auth\LoginController::class,'login_process'])->name('logins.login');
Route::get('/register',[Auth\RegisterController::class,'index']);
Route::post('/register',[Auth\RegisterController::class,'store'])->name('registers.register');
Route::get('/logout',[Auth\LoginController::class,'logout']);
