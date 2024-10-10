<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all(); // Lấy tất cả tác giả
        return view('authors.index', compact('authors')); // Trả về view
    }

    public function show($id)
    {
        $author = Author::findOrFail($id); // Tìm tác giả theo id
        return view('authors.show', compact('author')); // Trả về view
    }
}
