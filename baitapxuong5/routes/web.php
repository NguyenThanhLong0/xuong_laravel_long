<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/transaction/start', [TransactionController::class, 'startTransaction']);
Route::post('/transaction/confirm', [TransactionController::class, 'confirmTransaction']);
Route::post('/transaction/complete', [TransactionController::class, 'completeTransaction']);
Route::post('/transaction/cancel', [TransactionController::class, 'cancelTransaction']);

Route::get('/transaction', function () {
    return view('transaction');
});
