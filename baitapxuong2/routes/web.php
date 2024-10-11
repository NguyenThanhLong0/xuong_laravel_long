<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinancialReportController;
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



Route::get('/sales', [FinancialReportController::class, 'tongDoanhThuThang']);

Route::get('/expenses', [FinancialReportController::class, 'tongChiPhiThang']);

Route::get('/financial-report/{month}/{year}', [FinancialReportController::class, 'baoCaoTaiChinh']);
