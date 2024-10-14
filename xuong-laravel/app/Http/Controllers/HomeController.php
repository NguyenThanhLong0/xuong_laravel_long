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

        $posts = Post::with('category', 'author')->latest()->get();

        $categories = Category::all();

        $trendingPosts = Post::with('author')->latest()->take(5)->get();

        // Truyền cả ba biến vào view
        return view('client.index', compact('posts', 'categories', 'trendingPosts'));
    }

    public function showPost($id)
    {

        $post = Post::findOrFail($id);

        $categories = Category::latest('id')->get();

        $trendingPosts = Post::with('author')->latest()->take(5)->get();


        return view('client.single-post', compact('post', 'categories', 'trendingPosts'));
    }

    public function about()
    {

        $categories = Category::latest('id')->get();

        return view('client.abouts.about', compact('categories'));
    }

    public function contact()
    {

        $categories = Category::latest('id')->get();

        return view('client.contacts.contact', compact('categories'));
    }
}
