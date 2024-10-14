@extends('admin.layouts.master')

@section('title')
    Quản lý User
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách bài viết</h1>
                        </div>
                    </div>
                </div>

                <div class="white_card_body">
                    <div class="table-responsive">


   
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Thêm mới</a>


                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Excerpt</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Thumnnail</th>
                                        <th>Cover</th>
                                        <th>Status</th>
                                        <th>Is_trending</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr class="">
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->excerpt }}</td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>{{ $post->author->name }}</td>
                                            <td><img src="{{ Storage::url($post->img_thumbnail) }}" alt=""
                                                    width="100"></td>
                                            <td><img src="{{ Storage::url($post->img_cover) }}" alt=""
                                                    width="100">
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $post->status == 'published' ? 'bg-info' : 'bg-secondary' }}">
                                                    {{ $post->status == 'published' ? 'Published' : 'Draft' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $post->is_trending ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $post->is_trending ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>{{ $post->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.posts.show', $post->id) }}"
                                                    class="btn btn-info mb-2">Xem</a>
                                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                    class="btn btn-warning mb-2">Sửa</a>
                                                <form action="{{ route('admin.posts.destroy', $post) }}"
                                                    class="d-inline mb-2" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Bạn có chắc chắn chắn muốn xóa không?')"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Phân trang -->
                            <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
