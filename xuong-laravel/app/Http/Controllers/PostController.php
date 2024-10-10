<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag; // Import Tag model
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Hiển thị danh sách tất cả bài viết
    public function index()
    {
        // $posts = Post::with('tags')->get(); // Lấy tất cả bài viết với các thẻ

        // Lấy tất cả bài viết, bao gồm tác giả và thể loại
        $posts = Post::with(['author', 'category','tag'])->get();

        return view('posts.index', compact('posts')); 
        // Trả về view danh sách
    }

        // Hiển thị chi tiết bài viết
        public function show($id)
        {
            $post = Post::with('images', 'category','tags')->findOrFail($id); // Tìm bài viết theo id và lấy luôn các thẻ
            return view('posts.show', compact('post')); // Trả về view chi tiết bài viết
        }

    // Hiển thị form tạo bài viết
    public function create()
    {
        $tags = Tag::all(); // Lấy tất cả các thẻ để gán cho bài viết
        return view('posts.create', compact('tags')); 
        // Trả về view form tạo bài viết
    }

    // Xử lý lưu bài viết mới
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|max:255',
            'excerpt' => 'nullable',
            'img_thumbnail' => 'required|max:255',
            'img_cover' => 'nullable|max:255',
            'content' => 'nullable',
            'is_trending' => 'boolean',
            'view_count' => 'integer',
            'status' => 'required|in:draft,published',
            'tags' => 'array', // Validate mảng tags
            'tags.*' => 'exists:tags,id' // Kiểm tra từng tag có tồn tại không
        ]);

        // Tạo mới bài viết
        $post = Post::create($request->all());

        // Gắn tags vào bài viết
        $post->tags()->sync($request->tags);

        // Chuyển hướng về trang danh sách bài viết với thông báo
        return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo thành công.');
    }



    // Hiển thị form chỉnh sửa bài viết
    public function edit($id)
    {
        $post = Post::findOrFail($id); // Tìm bài viết theo id
        $tags = Tag::all(); // Lấy tất cả các thẻ
        return view('posts.edit', compact('post', 'tags')); // Trả về view form chỉnh sửa bài viết
    }

    // Xử lý cập nhật bài viết
    public function update(Request $request, $id)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|max:255',
            'excerpt' => 'nullable',
            'img_thumbnail' => 'required|max:255',
            'img_cover' => 'nullable|max:255',
            'content' => 'nullable',
            'is_trending' => 'boolean',
            'view_count' => 'integer',
            'status' => 'required|in:draft,published',
            'tags' => 'array', // Validate mảng tags
            'tags.*' => 'exists:tags,id' // Kiểm tra từng tag có tồn tại không
        ]);

        // Tìm bài viết theo id và cập nhật
        $post = Post::findOrFail($id);
        $post->update($request->all());

        // Cập nhật tags cho bài viết
        $post->tags()->sync($request->tags);

        // Chuyển hướng về trang chi tiết bài viết với thông báo
        return redirect()->route('posts.show', $id)->with('success', 'Bài viết đã được cập nhật.');
    }

    // Xóa bài viết
    public function destroy($id)
    {
        $post = Post::findOrFail($id); // Tìm bài viết theo id
        $post->tags()->detach(); // Xóa các liên kết với thẻ trước khi xóa bài viết
        $post->delete(); // Xóa bài viết

        // Chuyển hướng về trang danh sách bài viết với thông báo
        return redirect()->route('posts.index')->with('success', 'Bài viết đã được xóa.');
    }
}
