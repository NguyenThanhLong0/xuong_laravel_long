<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::query()->latest('id')->get();

        return view('client.master', compact('categories'));
    }


    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            // Lấy dữ liệu
            $data = $request->only(['name']);

            // Tạo mới category
            Category::create($data);

            return redirect()->route('categories.index')
                ->with('success', 'Thêm mới tahnhf công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm mới thất bại!');
        }
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        $category = Category::with('posts')->findOrFail($id); // Lấy danh mục kèm theo các bài viết
        return view('client.index', compact('category')); // Trả về view với danh mục
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
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

            return redirect()->route('categories.index')
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

            return redirect()->route('categories.index')
                ->with('success', 'Xóa thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Xóa thất bại!');
        }
    }
    public function filterByCategory($id)
    {
        // $posts = Post::with('category', 'author')->where('category_id', $id)->get(); // Lấy bài viết theo danh mục
        // $categories = Category::all(); // Lấy tất cả danh mục
        // return view('client.index', compact('posts', 'categories')); // Truyền cả hai biến vào view

        // Lógica để lấy bài viết theo danh mục
        $posts = Post::where('category_id', $id)->latest()->get();
        $categories = Category::latest('id')->get();

        return view('client.index', compact('posts', 'categories'));
    }
}
