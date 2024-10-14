<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag; // Import Tag model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    const PARTH_VIEW = 'admin.posts.';
    public function index()
    {

        $posts = Post::with(['author', 'category', 'tags'])->latest('id')->paginate(5);


        return view(self::PARTH_VIEW . __FUNCTION__, compact('posts'));
    }


    public function show($id)
    {
        $post = Post::with('category', 'tags')->findOrFail($id); // Tìm bài viết theo id và lấy luôn các thẻ
        return view(self::PARTH_VIEW . __FUNCTION__, compact('post'));
    }

    // Hiển thị form tạo bài viết
    public function create()
    {
        $categories = Category::all();

        $authors = Author::all();

        $tags = Tag::all();

        return view(self::PARTH_VIEW . __FUNCTION__, compact('categories', 'authors', 'tags'));
    }

    // Xử lý lưu bài viết mới
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:255',
            'category_id'   => 'required|exists:categories,id',
            'author_id'     => 'required|exists:authors,id',
            'excerpt'       => 'nullable|string',
            'img_thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'img_cover'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'status'        => 'required|in:draft,published',
            'is_trending'   => 'nullable|boolean',
            'tags'          => 'nullable|array',
            'tags.*'        => 'exists:tags,id',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Lấy dữ liệu từ request nhưng loại bỏ ảnh
            $data = $request->except(['img_thumbnail', 'img_cover']);


            if ($request->hasFile('img_thumbnail')) {
                $data['img_thumbnail'] = $request->file('img_thumbnail')->store('thumbnails', 'public');
            }


            if ($request->hasFile('img_cover')) {
                $data['img_cover'] = $request->file('img_cover')->store('covers', 'public');
            }

  
            Post::query()->create($data);

            return redirect()->route('admin.posts.index')->with('success', 'Thêm mới bài viết thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm mới bài viết thất bại!');
        }
    }


    public function edit($id)
    {
        // Tìm bài viết theo id và lấy thẻ liên kết
        $post = Post::with('tags')->findOrFail($id);

        // Tải tất cả các tác giả và thể loại
        $tags = Tag::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'tags', 'authors', 'categories'));
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:255',
            'category_id'   => 'required|exists:categories,id',
            'author_id'     => 'required|exists:authors,id',
            'excerpt'       => 'nullable|string',
            'img_thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'img_cover'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'status'        => 'required|in:draft,published',
            'is_trending'   => 'nullable|boolean',
            'tags'          => 'nullable|array',
            'tags.*'        => 'exists:tags,id',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Tìm bài viết theo id
        $post = Post::findOrFail($id);

        try {

            $data = $request->except(['img_thumbnail', 'img_cover']);


            if ($request->hasFile('img_thumbnail')) {
                $data['img_thumbnail'] = $request->file('img_thumbnail')->store('thumbnails', 'public');
            }


            if ($request->hasFile('img_cover')) {
                $data['img_cover'] = $request->file('img_cover')->store('covers', 'public');
            }


            $post->update($data);

            // Cập nhật tags cho bài viết
            $post->tags()->sync($request->tags);


            return redirect()->route('admin.posts.index', $id)->with('success', 'Bài viết đã được cập nhật.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cập nhật bài viết thất bại!');
        }
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Xóa các liên kết với thẻ trước khi xóa bài viết
        $post->tags()->detach();


        if (Storage::exists($post->img_thumbnail)) {
            Storage::delete($post->img_thumbnail);
        }


        if (Storage::exists($post->img_cover)) {
            Storage::delete($post->img_cover);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa.');
    }


    // comment
    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Comment::create([
            'post_id' => $postId,
            'name' => $request->name,
            'body' => $request->body,
        ]);

        return redirect()->route('single.post', $postId)
            ->with('success', 'Bình luận đã được thêm thành công!');
    }
}
