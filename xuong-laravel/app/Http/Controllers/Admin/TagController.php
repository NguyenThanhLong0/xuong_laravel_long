<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    const PARTH_VIEW = 'admin.tags.';

    public function index()
    {
        $data = Tag::latest('id')->paginate(5);

        return view(self::PARTH_VIEW . __FUNCTION__, compact('data'));
    }

    public function show($id)
    {
        $tag = Tag::findOrFail($id); // Tìm tag theo id

        return view(self::PARTH_VIEW . __FUNCTION__, compact('tag')); // Trả về view
    }

    public function create()
    {
        return view(self::PARTH_VIEW . __FUNCTION__);
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $data = $request->only('name');

            Tag::create($data);


            return redirect()->route('admin.tags.index')
                ->with('success', 'thêm mới tag thành công!');
        } catch (\Throwable $th) {
            // Điều hướng lại trang tạo với thông báo lỗi
            return back()->with('error', 'Thêm mới thất bại');
        }
    }

    public function edit($id)
    {
        try {
            $tag = Tag::findOrFail($id);

            return view(self::PARTH_VIEW . __FUNCTION__, compact('tag'));
        } catch (\Throwable $th) {

            return redirect()->route('admin.tags.index')->with('error', 'fail');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $tag = Tag::findOrFail($id);


            $tag->update($request->only('name'));


            return redirect()->route('admin.tags.index')->with('success', 'Update tag thành công!');
        } catch (\Throwable $th) {
            // Điều hướng về trang sửa với thông báo lỗi
            return back()->with('error', 'Update tag thất bại!');
        }
    }

    public function destroy($id)
    {
        try {
            // Tìm tag theo id và xóa
            $tag = Tag::findOrFail($id);
            $tag->delete();


            return back()->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return  back()->with('success', 'false');
        }
    }
}
