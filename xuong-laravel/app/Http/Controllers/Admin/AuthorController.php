<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    const PARTH_VIEW = 'admin.authors.';

    public function index()
    {
        // $authors = Author::all(); // Lấy tất cả tác giả
        $authors = Author::latest('id')->paginate(5);

        return view(self::PARTH_VIEW . __FUNCTION__, compact('authors')); // Trả về view
    }

    public function show($id)
    {
        $author = Author::findOrFail($id); // Tìm tác giả theo id
        return view(self::PARTH_VIEW . __FUNCTION__, compact('author')); // Trả về view
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except('avatar');

            if ($request->hasFile('avatar')) {
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            Author::create($data);

            return redirect()->route('admin.authors.index')->with('success', 'Tác giả đã được thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm mới tác giả thất bại!');
        }
    }

    // Hiển thị form chỉnh sửa tác giả
    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view(self::PARTH_VIEW . __FUNCTION__, compact('author'));
    }

    // Xử lý cập nhật thông tin tác giả
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $author = Author::findOrFail($id);

        try {
            $data = $request->except('avatar');

            if ($request->hasFile('avatar')) {
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            $author->update($data);

            return redirect()->route('admin.authors.index')->with('success', 'Thông tin tác giả đã được cập nhật.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cập nhật tác giả thất bại!');
        }
    }

    // Xóa tác giả
    public function destroy($id)
    {
        try {
            $author = Author::findOrFail($id);

            if (Storage::exists($author->avatar)) {
                Storage::delete($author->avatar);
            }

            $author->delete();


            return back()->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return  back()->with('success', 'false');
        }
    }
}
