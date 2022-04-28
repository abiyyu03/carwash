<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('owner')->group(function(){
    Route::get('/',[DashboardController::class,'index']);

    //transaction
    Route::get('/transaction',[TransactionController::class,'index']);
    Route::get('/transaction/delete/{id_transaction}',[TransactionController::class,'deleteTransaction']);
    Route::get('/transactionJson',[TransactionController::class,'transactionJson'])->name('transaction.transactionJson');
    Route::post('/transaction/checkout',[TransactionController::class,'createCustomerAndTransactionWithNewCustomerData'])->name('transaction.create');
    Route::post('/transaction/checkouts',[TransactionController::class,'createCustomerAndTransactionWithExistingCustomerData'])->name('transaction.useExisting');
    Route::post('/transaction/detail/store',[TransactionController::class,'storeTransactionDetail'])->name('transaction.storeTransactionDetail');
    Route::get('/transaction/{id_transaction}/selectProduct',[TransactionController::class,'checkout']);

    //Vehicle type
    Route::get('/vehicle_type',[VehicleTypeController::class,'index']);
    Route::post('/vehicle_type/store',[VehicleTypeController::class,'store'])->name('vehicle_type.store');

    //customer
    Route::get('/customer',[CustomerController::class,'index']);
    Route::get('/customerJson',[CustomerController::class,'customerJson'])->name('customer.customerJson');
    // Route::get('/customer/edit/{id_customer}',[CustomerController::class,'edit']);

    //product category
    Route::get('/product_category',[ProductCategoryController::class,'index']);
    Route::get('/product_categoryJson',[ProductCategoryController::class,'productCategoryJson'])->name('productCategory.productCategoryJson');
    Route::post('/product_category/store',[ProductCategoryController::class,'store'])->name('product_category.store');

    //product 
    Route::get('/product',[ProductController::class,'index']);
    Route::get('/productJson',[ProductController::class,'productJson'])->name('product.productJson');
    Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
    // Route::get('/product/edit/{id}',[ProductController::class,'edit']);
    // Route::get('/product/update',[ProductController::class,'update'])->name('product.update');

    //Employee 
    Route::get('/employee',[EmployeeController::class,'index']);
    Route::get('/employeeJson',[EmployeeController::class,'employeeJson'])->name('employee.employeeJson');
    Route::post('/employee/store',[EmployeeController::class,'store'])->name('employee.store');
    
    //Inventory
    Route::get('/inventory',[InventoryController::class,'index']);
    Route::get('/inventoryJson',[InventoryController::class,'inventoryJson'])->name('inventory.inventoryJson');
    Route::post('/inventory/store',[InventoryController::class,'store'])->name('inventory.store');

});

Route::middleware('supervisor')->group(function(){
    Route::get('/asdd', function () {
        return 'supervisor';    
    });
});

Route::middleware('cashier')->group(function(){
    // Route::get('/',[DashboardController::class,'index']);
    Route::get('/asd', function () {
        return 'cashier';    
    });
});

//Authentication's route 
Route::get('/login',[Auth\LoginController::class,'login']);
Route::post('/login',[Auth\LoginController::class,'login_process'])->name('logins.login');
Route::get('/register',[Auth\RegisterController::class,'index']);
Route::post('/register',[Auth\RegisterController::class,'store'])->name('registers.register');
Route::get('/logout',[Auth\LoginController::class,'logout']);

// Route::get('/login_owner',[Auth\LoginController::class,'login_owner']);
// Route::post('/login_owner',[Auth\LoginController::class,'login_owner_process'])->name('login_owner.login');
// Route::get('/logout_owner',[Auth\LoginController::class,'logout_owner']);

// Route::get('/login_supervisor',[Auth\LoginController::class,'login_supervisor']);
// Route::post('/login_supervisor',[Auth\LoginController::class,'login_supervisor_process'])->name('login_supervisor.login');
// Route::get('/logout_supervisor',[Auth\LoginController::class,'logout_supervisor']);

// Route::get('/login_cashier',[Auth\LoginController::class,'login_cashier']);
// Route::post('/login_cashier',[Auth\LoginController::class,'login_cashier_process'])->name('login_cashier.login');
// Route::get('/logout_cashier',[Auth\LoginController::class,'logout_cashier']);

// Route::get('/register',[Auth\RegisterController::class,'register']);
// Route::post('/register',[Auth\RegisterController::class,'register_process'])->name('registers.register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
