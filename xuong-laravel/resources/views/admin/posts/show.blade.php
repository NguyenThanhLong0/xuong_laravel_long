@extends('admin.layouts.master')

@section('title')
    Xem chi tiết bài viết
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Chi tiết bài viết</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <td>{{ $post->id }}</td>
                            </tr>
                            <tr>
                                <th>Tiêu đề</th>
                                <td>{{ $post->title }}</td>
                            </tr>
                            <tr>
                                <th>Tóm tắt</th>
                                <td>{{ $post->excerpt }}</td>
                            </tr>
                            <tr>
                                <th>Thể loại</th>
                                <td>{{ $post->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Tác giả</th>
                                <td>{{ $post->author->name }}</td>
                            </tr>
                            <tr>
                                <th>Ảnh Thumbnail</th>
                                <td><img src="{{ Storage::url($post->img_thumbnail) }}" alt="" width="100"></td>
                            </tr>
                            <tr>
                                <th>Ảnh Bìa</th>
                                <td><img src="{{ Storage::url($post->img_cover) }}" alt="" width="100"></td>
                            </tr>
                            <tr>
                                <th>Nội dung</th>
                                <td>{{ $post->content }}</td>
                            </tr>
                            <tr>
                                <th>Thẻ</th>
                                <td>
                                    @foreach ($post->tags as $tag)
                                        <span class="badge badge-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>{{ $post->status }}</td>
                            </tr>
                            <tr>
                                <th>Is Trending</th>
                                <td>{{ $post->is_trending ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>View Count</th>
                                <td>{{ $post->view_count }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
