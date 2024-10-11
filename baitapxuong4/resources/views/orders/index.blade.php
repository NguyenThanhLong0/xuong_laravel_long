@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Quản Lý Đơn Hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách Hàng</th>
                    <th>Tình Trạng</th>
                    <th>Ngày Tạo</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu đơn hàng sẽ được đưa vào đây -->
                <tr>
                    <td>1</td>
                    <td>Nguyễn Văn A</td>
                    <td>Đang xử lý</td>
                    <td>2024-10-07</td>
                    <td><a href="#" class="btn btn-primary">Xem Chi Tiết</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Trần Thị B</td>
                    <td>Hoàn thành</td>
                    <td>2024-10-05</td>
                    <td><a href="#" class="btn btn-primary">Xem Chi Tiết</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
