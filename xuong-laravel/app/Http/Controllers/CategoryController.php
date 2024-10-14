<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()->latest('id')->paginate(5);


        // Kiểm tra nếu truy cập từ trang admin hoặc client
        if ($request->is('admin/*')) {
            // Trả về trang admin
            return view('admin.categories.index', compact('categories'));
        } else {
            // Trả về trang client
            return view('client.master', compact('categories'));
        }
    }

    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {

            $data = $request->only(['name']);

  
            Category::create($data);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm mới thất bại!');
        }
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {


        $category = Category::with('posts')->findOrFail($id); 

        return view('client.index', compact('category')); 
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            // Lấy dữ liệu
            $data = $request->only(['name']);

            // Cập nhật category
            $category->update($data);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cập nhật thất bại!');
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return back()->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Xóa thất bại!');
        }
    }
    // public function filterByCategory($id)
    // {

    //     // Lógica để lấy bài viết theo danh mục
    //     $posts = Post::where('category_id', $id)->latest()->get();
    //     $categories = Category::latest('id')->get();
    //     $trendingPosts = Post::with('author')->latest()->take(5)->get();

    //     return view('client.index', compact('posts', 'categories', 'trendingPosts'));
    // }

    public function filter($id)
    {
        $categories = Category::latest('id')->get();
        $posts = Post::where('category_id', $id)->with(['author'])->latest()->get();


        $trendingPosts = Post::with('author')->latest()->take(5)->get();

        // Truyền các biến vào view
        return view('client.index', compact('categories', 'posts', 'trendingPosts'));
    }
}
