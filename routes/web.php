<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



/**
* Authentication Area
*/
//Auth's route 
Route::get('/login',[Auth\LoginController::class,'login']);
Route::get('/owner/login',[Auth\LoginController::class,'login']);
Route::post('/login',[Auth\LoginController::class,'login_process'])->name('logins.login');
// Route::get('/register',[Auth\RegisterController::class,'index']);
// Route::post('/register',[Auth\RegisterController::class,'store'])->name('registers.register');
Route::get('/logout',[Auth\LoginController::class,'logout']);
Route::get('/forgot-password',[Auth\ResetPasswordController::class,'getResetPassword'])->name('password.request');
Route::post('/forgot-password', [Auth\ResetPasswordController::class,'sendResetPassword'])->name('password.email');
Route::get('/reset-password/{token}',[Auth\ResetPasswordController::class,'getResetPasswordToken'])->name('password.reset');
Route::post('/reset-password',[Auth\ResetPasswordController::class,'processResetPassword'])->name('password.update');

/**
* This is Route area
* the middleware can see in every end of route
* every route is group by feature
*/
//user (account)
Route::get('/account',[UserController::class,'index'])
    ->middleware('role:supervisor,owner');
Route::get('/userJson',[UserController::class,'userJson'])->name('user.userJson')
    ->middleware('role:supervisor,owner');

//customer
Route::get('/customer',[CustomerController::class,'index'])
->middleware('role:supervisor,owner');
Route::get('/customerJson',[CustomerController::class,'customerJson'])->name('customer.customerJson')
->middleware('role:supervisor,owner');
Route::get('/customer/delete/{id_customer}',[CustomerController::class,'delete'])
->middleware('role:supervisor,owner');
Route::put('/customer/update/{id_customer}',[CustomerController::class,'update'])
->middleware('role:supervisor,owner');

//product category
Route::get('/product_category',[ProductCategoryController::class,'index'])
->middleware('role:supervisor,owner');
Route::get('/product_categoryJson',[ProductCategoryController::class,'productCategoryJson'])
->name('productCategory.productCategoryJson')
->middleware('role:supervisor,owner');
Route::post('/product_category/store',[ProductCategoryController::class,'store'])
->name('product_category.store')
->middleware('role:supervisor,owner');
Route::get('/product-category/delete/{id_product_category}',[ProductCategoryController::class,'delete'])
->middleware('role:supervisor,owner');
Route::put('/product-category/update/{id_product_category}',[ProductCategoryController::class,'update'])
->name('product_category.update')
->middleware('role:supervisor,owner');

//product 
Route::get('/product',[ProductController::class,'index'])
->middleware('role:supervisor,owner');
Route::get('/product/category/{product_category_id}',[ProductController::class,'indexes'])
->middleware('role:supervisor,owner');
Route::get('/productJson',[ProductController::class,'productJson'])
->name('product.productJson')
->middleware('role:supervisor,owner');
Route::post('/product/store',[ProductController::class,'store'])
->name('product.store')
->middleware('role:supervisor,owner');
Route::get('/product/delete/{id_product}',[ProductController::class,'delete'])
->middleware('role:supervisor,owner');
// Route::get('/product/edit/{id}',[ProductController::class,'edit']);
Route::put('/product/update/{id_product}',[ProductController::class,'update'])
->name('product.update')
->middleware('role:supervisor,owner');
Route::put('/product/discount/create/{id_product}',[ProductController::class,'addProductDiscount'])
->middleware('role:supervisor,owner');

//outcome
Route::get('/outcome',[OutcomeController::class,'index'])
->name('outcome.index')
->middleware('role:supervisor,owner');
Route::post('/outcome',[OutcomeController::class,'store'])
->name('outcome.store')
->middleware('role:supervisor,owner');

//Employee 
Route::get('/employee',[EmployeeController::class,'index'])
->middleware('role:supervisor,owner');
Route::get('/employeeJson',[EmployeeController::class,'employeeJson'])
->name('employee.employeeJson')
->middleware('role:supervisor,owner');
Route::post('/employee/store',[EmployeeController::class,'store'])
->name('employee.store')
->middleware('role:supervisor,owner');
Route::get('/employee/delete/{id_employee}',[EmployeeController::class,'delete'])
->middleware('role:supervisor,owner');
Route::put('/employee/update/{id_employee}',[EmployeeController::class,'update'])
->middleware('role:supervisor,owner');
Route::get('/employee/commission',[CommissionController::class,'index'])
->middleware('role:supervisor,owner');
Route::get('/employee/count/{id_employee}',[CommissionController::class,'setCommission'])
->middleware('role:supervisor,owner');
Route::get('/employee/commissionJson',[EmployeeController::class,'commissionJson'])
->name('commission.commissionJson')
->middleware('role:supervisor,owner');
Route::get('/employee/attendanceJson',[AttendanceController::class,'attendanceJson'])
->name('attendance.attendanceJson')
->middleware('role:supervisor,owner');
Route::get('/employee/attendance',[AttendanceController::class,'index'])
->middleware('role:supervisor,owner');
Route::get('/employee/attendance/report/pdf',[AttendanceController::class,'printPDFReport'])
->middleware('role:supervisor,owner');

// Attendance
Route::get('/employee/attendance',[AttendanceController::class,'index'])
->name('attendance.index')
->middleware('role:supervisor,owner');

//Inventory
Route::get('/inventory',[InventoryController::class,'index'])
->middleware('role:supervisor,owner');
Route::get('/inventoryJson',[InventoryController::class,'inventoryJson'])
->name('inventory.inventoryJson')
->middleware('role:supervisor,owner');
Route::post('/inventory/store',[InventoryController::class,'store'])
->name('inventory.store')
->middleware('role:supervisor,owner');
Route::put('/inventory/update/{id_inventory}',[InventoryController::class,'update'])
->name('inventory.update')
->middleware('role:supervisor,owner');
Route::get('/inventory/delete/{id_inventory}',[InventoryController::class,'delete'])
->middleware('role:supervisor,owner');

//Report
Route::get('/report/daily',[ReportController::class,'dailyReport'])
    ->name('report.daily')
    ->middleware('role:supervisor,owner');
Route::get('/report/monthly',[ReportController::class,'monthlyReport'])
    ->middleware('role:supervisor,owner');
Route::get('/report/summary',[ReportController::class,'summaryReport'])
    ->name('summary.index')
    ->middleware('role:supervisor,owner');
Route::get('/report/getTotal',[ReportController::class,'getTotal'])
    ->middleware('role:supervisor,owner');
Route::get('/report/product/all',[ReportController::class,'reportAllProduct'])
    ->name('report.allProduct')
    ->middleware('role:supervisor,owner');
Route::get('/report/monthly',[ReportController::class,'monthlyReport'])
    ->name('report.monthly')
    ->middleware('role:supervisor,owner');
Route::get('/report/summary/pdf',[ReportController::class,'exportSummaryPDF'])
    ->middleware('role:supervisor,owner');

//shopping
Route::get('/shopping',[InventoryDetailController::class,'index'])->middleware('role:supervisor,owner');
Route::post('/shopping/store',[InventoryDetailController::class,'store'])->name('inventoryDetail.store')->middleware('role:supervisor,owner');
Route::get('/shopping/delete/{id_inventory_detail}',[InventoryDetailController::class,'delete'])->middleware('role:supervisor,owner');
Route::put('/shopping/update/{id_inventory_detail}',[InventoryDetailController::class,'update'])->name('supplier.update')->middleware('role:supervisor,owner');

//Supplier
Route::get('/supplier',[SupplierController::class,'index'])->middleware('role:supervisor,owner');

//Promo
Route::get('/promo/product/',[PromoController::class,'index'])->name('productPromo')->middleware('role:supervisor,owner');
Route::post('/promo/product/store',[PromoController::class,'store'])->name('promo.store')->middleware('role:supervisor,owner');
// Route::get('/promo',[PromoController::class,'index'])->middleware('role:supervisor,owner');

//invoice
Route::get('/invoice',[InvoiceController::class,'index'])->middleware('role:supervisor,owner');
Route::get('/',[DashboardController::class,'index'])->middleware('role:cashier,supervisor,owner');

//transaction
Route::get('/transaction',[TransactionController::class,'index'])->middleware('role:cashier,supervisor,owner');
Route::get('/transaction/delete/{id_transaction}',[TransactionController::class,'deleteTransaction'])->middleware('role:cashier,supervisor,owner');
Route::get('/transactionJson',[TransactionController::class,'transactionJson'])->name('transaction.transactionJson')->middleware('role:cashier,supervisor,owner');
Route::get('/getCustomerData',[TransactionController::class,'getCustomerData'])->name('getCustomerData')->middleware('role:cashier,supervisor,owner');
Route::get('/getPlateData',[TransactionController::class,'getPlateData'])->name('getPlateData')->middleware('role:cashier,supervisor,owner');
Route::post('/transaction/checkout/create-new',[TransactionController::class,'createCustomerAndTransactionWithNewCustomerData'])->name('transaction.create')->middleware('role:cashier,supervisor,owner');
Route::post('/transaction/checkout/use-existing',[TransactionController::class,'createCustomerAndTransactionWithExistingCustomerData'])->name('transaction.useExisting')->middleware('role:cashier,supervisor,owner');

// Transaction Detail
Route::post('/transaction/detail/store',[TransactionController::class,'storeTransactionDetail'])
->name('transaction.storeTransactionDetail')
->middleware('role:cashier,supervisor,owner');
Route::get('/transaction/{id_transaction}/detail/delete/{id_transaction_detail}',[TransactionController::class,'deleteTransactionDetail'])
->middleware('role:cashier,supervisor,owner');
Route::get('/transaction/{id_transaction}/select-product',[TransactionController::class,'checkout'])
->middleware('role:cashier,supervisor,owner');
Route::get('/transaction/{id_transaction}/finish',[TransactionController::class,'processTransaction'])
->middleware('role:cashier,supervisor,owner');
Route::get('/transaction/getTotal/{id_transaction}',[TransactionController::class,'getTotal'])
->middleware('role:cashier,supervisor,owner');

// config
Route::get('/config',[ConfigController::class,'index']);
Route::put('/config/user-edit/{id_user}',[ConfigController::class,'edit']);
Route::put('/config/user-update/{id_user}',[ConfigController::class,'update'])->name('user.update');
Route::put('/config/config-update/{id_config}',[ConfigController::class,'updateConfig'])->name('config.update');
// });


Route::get('/dropdownProduct',[TransactionController::class,'dropdownProduct'])
    ->name('dropdownProduct');
    // ->middleware('role:supervisor,owner');
Route::get('/getProductProduct',[TransactionController::class,'getProductProduct'])
    ->name('getProductProduct');
    // ->middleware('role:supervisor,owner');
