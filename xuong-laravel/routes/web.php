<?php

// use App\Http\Controllers\Admin\SupplierController;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\PostController;
// use App\Models\Category;
// use App\Models\Post;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

// Route::get('/', function () {

//     $categories = Category::latest('id')->get(); // Lấy danh sách các danh mục

//     return view('client.index', compact('categories')); // Truyền biến categories vào view
// })->name('home');


// Route::get('/single-post/{id}', function ($id) {
//     $post = Post::findOrFail($id); // Lấy bài viết theo id
//     $categories = Category::latest('id')->get(); // Lấy danh sách các danh mục

//     return view('client.single-post', compact('post', 'categories')); // Truyền biến post và categories vào view
// })->name('single.post');


// Route::resource('categories', CategoryController::class);

// Auth::routes();
// cho cái này vào ngoặc nếu muốn xaác thực emai: ['verify' => true]

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// routes/web.php

use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController;
use App\Models\Category;
use App\Models\Post;
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

// Route cho trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('abouts', [HomeController::class, 'about'])->name('abouts');

Route::get('contacts', [HomeController::class, 'contact'])->name('contacts');

// Route cho danh sách bài viết
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// comments
Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('comments.store');

// Route cho bài viết chi tiết
Route::get('/single-post/{id}', [HomeController::class, 'showPost'])->name('single.post');

// show categories
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');


// Resource routes cho categories
Route::resource('categories', CategoryController::class);

// Đăng nhập
Auth::routes(['verify' => true]);
// cho cái này vào ngoặc nếu muốn xaác thực emai: ['verify' => true]

// Route cho việc lọc theo danh mục
Route::get('/categories/filter/{id}', [CategoryController::class, 'filter'])->name('categories.filter');
