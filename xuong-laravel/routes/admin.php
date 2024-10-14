<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SupplierController;

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

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    Route::resource('users', UserController::class);

    Route::resource('tags', TagController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('authors', AuthorController::class);

    Route::resource('posts', PostController::class);

    Route::resource('comments', CommentController::class);
});
