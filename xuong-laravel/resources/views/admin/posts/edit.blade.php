@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa bài viết
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Chỉnh sửa bài viết</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="category_id">Thể loại</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Chọn thể loại</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="author_id">Tác giả</label>
                            <select name="author_id" class="form-control" required>
                                <option value="">Chọn tác giả</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}"
                                        {{ $post->author_id == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Tóm tắt</label>
                            <textarea name="excerpt" class="form-control">{{ $post->excerpt }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" class="form-control" required>{{ $post->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="img_thumbnail">Ảnh Thumbnail</label>
                            <input type="file" name="img_thumbnail" class="form-control">
                            <small>Để lại trống nếu không thay đổi</small>
                        </div>

                        <div class="form-group">
                            <label for="img_cover">Ảnh Bìa</label>
                            <input type="file" name="img_cover" class="form-control">
                            <small>Để lại trống nếu không thay đổi</small>
                        </div>

                        <div class="form-group">
                            <label for="tags">Thẻ</label>
                            <select name="tags[]" class="form-control" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, $post->tags->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control" required>
                                <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_trending">Is Trending</label>
                            <input type="checkbox" name="is_trending" value="1"
                                {{ $post->is_trending ? 'checked' : '' }}>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
