<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


// 1.Truy vấn kết hợp nhiều bảng (JOIN):
Route::get('/cau1', function () {
    $query = DB::table('users as u')
        ->join('orders as o', 'u.id', '=', 'o.user_id')
        ->select('u.name', DB::raw('SUM(o.amount) as total_spent'))
        ->groupBy('u.name')
        ->having('total_spent', '>', 1000)
        ->ddRawSql();
});

// 2.Truy vấn thống kê dựa trên khoảng thời gian (Time-based statistics)
Route::get('/cau2', function () {
    $query = DB::table('orders')
        ->select(DB::raw('DATE(order_date) as date'), DB::raw('COUNT(*) as orders_count'), DB::raw('SUM(total_amount) as total_sal'))
        ->whereBetween('order_date', ['2024-01-01', '2024-09-30'])
        ->groupBy(DB::raw('DATE(order_date)'))
        ->ddRawSql();
});

// 3.Truy vấn để tìm kiếm giá trị không có trong tập kết quả khác (NOT EXISTS):
Route::get('/cau3', function () {
    $query = DB::table('products as p')
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('orders as o')
                ->whereColumn('o.product_id', 'p.id');
        })
        ->select('p.product_name')
        ->ddRawSql();
});

// 4.Truy vấn với CTE (Common Table Expression):
Route::get('/cau4', function () {
    // ph viết câu truy vấn CTE dưới dạng thô
    $cau4 = "
    WITH sales_cte AS (
        SELECT product_id, SUM(quantity) AS total_sold
        FROM sales
        GROUP BY product_id
    )
    SELECT p.product_name, s.total_sold
    FROM products p
    JOIN sales_cte s ON p.id = s.product_id
    WHERE s.total_sold > 100;
    ";

    dd($cau4);
});

// 5.Truy vấn lấy danh sách người dùng đã mua sản phẩm trong 30 ngày qua, cùng với thông tin sản phẩm và ngày mua
Route::get('/cau5', function () {
    $query = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->where('orders.order_date', '>=', DB::raw('NOW() - INTERVAL 30 DAY'))
        ->select('users.name', 'products.product_name', 'orders.order_date')
        ->ddRawSql();
});

// 6.Truy vấn lấy tổng doanh thu theo từng tháng, chỉ tính những đơn hàng đã hoàn thành 
Route::get('/cau6', function () {
    $query = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->where('orders.status', 'completed')
        ->select(DB::raw("DATE_FORMAT(orders.order_date, '%Y-%m') AS order_month"), DB::raw('SUM(order_items.quantity * order_items.price) AS total_revenue'))
        ->groupBy('order_month')
        ->orderBy('order_month', 'desc')
        ->ddRawSql();
});

// 7.Truy vấn các sản phẩm chưa từng được bán (sản phẩm không có trong bảng order_items)
Route::get('/cau7', function () {
    $query = DB::table('products')
        ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
        ->whereNull('order_items.product_id')
        ->select('products.product_name')
        ->ddRawSql();
});

// 8.Lấy danh sách các sản phẩm có doanh thu cao nhất cho mỗi loại sản phẩm
Route::get('/cau8', function () {
    $query = DB::table('products as p')
        ->join(DB::raw('(SELECT product_id, SUM(quantity * price) AS total FROM order_items GROUP BY product_id) as oi'), 'p.id', '=', 'oi.product_id')
        ->select('p.category_id', 'p.product_name', DB::raw('MAX(oi.total) AS max_revenue'))
        ->groupBy('p.category_id', 'p.product_name')
        ->orderBy('max_revenue', 'desc')
        ->ddRawSql();
});

// 9.Truy vấn thông tin chi tiết về các đơn hàng có giá trị lớn hơn mức trung bình
Route::get('/cau9', function () {
    $query = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select('orders.id', 'users.name', 'orders.order_date', DB::raw('SUM(order_items.quantity * order_items.price) AS total_value'))
        ->groupBy('orders.id', 'users.name', 'orders.order_date')
        ->having('total_value', '>', function ($query) {
            $query->select(DB::raw('AVG(total)'))
                ->from(DB::raw('(SELECT SUM(quantity * price) AS total FROM order_items GROUP BY order_id) AS avg_order_value'));
        });

    // In ra câu truy vấn SQL
    dd($query->toSql());
});

// 10. Truy vấn tìm tất cả các sản phẩm có doanh số cao nhất trong từng danh mục (category)
Route::get('/cau10', function () {
    $query = DB::table('products as p')
        ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
        ->select('p.category_id', 'p.product_name', DB::raw('SUM(oi.quantity) AS total_sold'))
        ->groupBy('p.category_id', 'p.product_name')
        ->having('total_sold', '=', function ($subQuery) {
            $subQuery->select(DB::raw('MAX(sub.total_sold)'))
                ->from(DB::raw('(SELECT product_name, SUM(quantity) AS total_sold 
                                 FROM order_items 
                                 JOIN products ON order_items.product_id = products.id 
                                 GROUP BY product_name) as sub'));
        });

    dd($query->toSql());
});



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

Route::get('/insert', function () {
    DB::table('posts')->insert([
        'title' => 'Tiêu đề của bài viết 4',
        'content' => 'Nội dung của bài viết 4',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    return "Đã thêm bài viết!";
});

// lấy taất cả bản ghi
Route::get('/get-all', function () {
    $posts = DB::table('posts')->get();
    return $posts;
});

//Lấy 1 bản ghi dựa trên id
Route::get('/get/{id}', function ($id) {
    $post = DB::table('posts')->where('id', $id)->first();
    return $post;
});

//update:
Route::get('/update', function () {
    $id = 3;
    DB::table('posts')
        ->where('id', $id)
        ->update([
            'title' => 'Tiêu đề mới 3',
            'updated_at' => now(),
        ]);
    return "Đã cập nhật bài viết!";
});

//Delete:
Route::get('/delete', function () {
    $id = 2;
    DB::table('posts')->where('id', $id)->delete();
    return "Đã xóa bài viết!";
});
