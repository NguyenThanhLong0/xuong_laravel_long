<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'excerpt',
        'img_thumbnail',
        'img_cover',
        'content',
        'is_trending',
        'view_count',
        'status',
    ];

    // Quan hệ với bảng categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ với bảng authors
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Liên kết nhiều-nhiều với Tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function mainImage()
    {
        return $this->img_cover;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
