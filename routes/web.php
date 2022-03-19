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

Route::middleware('owner')->group(function(){
    Route::get('/',[DashboardController::class,'index']);
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
Route::get('/register',[Auth\RegisterController::class,'register']);
Route::post('/register',[Auth\RegisterController::class,'register_process'])->name('registers.register');
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
