@extends('admin.layouts.master')

@section('title')
    Quản lý tag
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
                            <h1 class="m-0">Danh sách</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="table-responsive">


                        <!-- Button thêm mới -->
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Thêm mới</a>

                        <!-- Bảng danh sách -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $tag)
                                        <tr class="">
                                            {{-- <td scope="row">R1C1</td> --}}
                                            <td>{{ $tag->id }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.tags.show', $tag->id) }}"
                                                    class="btn btn-info">Xem</a>
                                                <a href="{{ route('admin.tags.edit', $tag->id) }}"
                                                    class="btn btn-warning">Sửa</a>
                                                <form action="{{ route('admin.tags.destroy', $tag) }}" class="d-inline"
                                                    method="post">
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
                            <div class="d-flex justify-content-center">{{ $data->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
