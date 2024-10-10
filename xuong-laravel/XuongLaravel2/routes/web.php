<?php

use App\Http\Controllers\CustomerController;
use App\Http\Middleware\FlagMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

    $users = DB::table('users')->get();

    return view('welcome', ['users' => $users]);
});

// Route::middleware([FlagMiddleware::class])->group(function () {
//     Route::resource('customers', CustomerController::class);
// });

Route::resource('customers', CustomerController::class)->middleware('auth');

// Đăng nhập
Auth::routes(['verify' => true]);
// cho cái này vào ngoặc nếu muốn xaác thực emai: ['verify' => true]


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('session', function () {
    session()->put('oders', []);

    // session()->put('oders.101', [
    //     'name' => 'Long',
    //     'price' => 100,
    // ]);

    // session(['oders.102' => [
    //     'name' => 'Huy',
    //     'price' => 200,
    // ]]);

    // session()->flash('keke', 'hahahahaha');

    // echo session('keke');

    return session()->all();
});
