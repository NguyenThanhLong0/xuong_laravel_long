<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // Trường category_id là khóa ngoại
            $table->unsignedBigInteger('author_id'); // Trường author_id là khóa ngoại
            $table->string('title', 255); // Tiêu đề bài viết
            $table->text('excerpt')->nullable(); // Tóm tắt bài viết
            $table->string('img_thumbnail', 255); // Ảnh thu nhỏ
            $table->string('img_cover', 255)->nullable(); // Ảnh bìa
            $table->text('content')->nullable(); // Nội dung bài viết
            $table->boolean('is_trending')->default(0); // Bài viết có xu hướng
            $table->integer('view_count')->default(0); // Số lượt xem
            $table->enum('status', ['draft', 'published']); // Trạng thái bài viết
            $table->timestamps(); 

            // Thiết lập khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
