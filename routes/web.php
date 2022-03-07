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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[DashboardController::class,'index']);
// owner
// Route::get('/owner',[ProductController::class,'indexOwner']);
// Route::get('/owner/login',[Auth\LoginController::class,'loginOwner']);
// Route::post('/owner/login',[Auth\LoginController::class,'authOwner'])->name('owner.login');

// // cashier
// Route::get('/cashier',[ProductController::class,'indexCashier']);
// Route::get('/cashier/login',[Auth\LoginController::class,'loginCashier']);
// Route::post('/cashier/login',[Auth\LoginController::class,'authCashier'])->name('cashier.login');
// Route::get('/product','app/Http/Controllers/ProductController@index');
