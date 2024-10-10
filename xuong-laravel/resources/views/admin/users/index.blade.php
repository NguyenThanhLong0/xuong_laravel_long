@extends('admin.layouts.master')

@section('title')
    Quản lý User
@endsection

@section('content')
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
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm mới</a>

                        <!-- Bảng danh sách -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>TYPE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $user)
                                        <tr class="">
                                            {{-- <td scope="row">R1C1</td> --}}
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->type }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $user->id) }}"
                                                    class="btn btn-info">Xem</a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-warning">Sửa</a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" class="d-inline"
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
