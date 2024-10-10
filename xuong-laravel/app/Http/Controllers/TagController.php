<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all(); // Lấy tất cả tag
        return view('tags.index', compact('tags')); // Trả về view
    }

    public function show($id)
    {
        $tag = Tag::findOrFail($id); // Tìm tag theo id

        return view('tags.show', compact('tag')); // Trả về view
    }
}
