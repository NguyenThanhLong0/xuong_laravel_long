<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('client.index');

        $posts = Post::with('category', 'author')->latest()->get(); // Lấy danh sách bài viết mới nhất
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('client.index', compact('posts', 'categories')); // Truyền cả hai biến vào view
    }
}
