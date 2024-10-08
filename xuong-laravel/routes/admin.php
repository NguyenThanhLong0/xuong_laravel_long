<?php

use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 

// Route::prefix('admin')
//     ->as('admin.')
//     ->group(function () {

//         Route::get('/', function () {
//             return view('admin.dashboard');
//         })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        

        Route::resource('users', UserController::class);
    });

