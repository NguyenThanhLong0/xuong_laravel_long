@extends('master')

@section('title')
    Danh sách Nhân viên
@endsection

@section('content')
    {{-- thông báo thành công --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <a href="{{ route('employees.create') }}" class="btn btn-primary">Thêm mới</a>

    <table class="table table-bordered mt-2 mb-2">
        <tr>
            <th>ID</th>
            <th>Ảnh đại diện</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Phòng ban</th>
            <th>Quản lý</th>
            <th>Lương</th>
            <th>Trạng thái</th>
            <th>Ngày thuê</th>
            <th>Thao tác</th>
        </tr>

        @foreach ($data as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>
                    @if ($employee->profile_picture)
                        <img src="{{ Storage::url($employee->profile_picture) }}" alt="Profile Picture" width="50">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Picture" width="50">
                    @endif
                </td>
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->department_id }}</td>
                <td>{{ $employee->manager_id }}</td>
                <td>{{ number_format($employee->salary, 2) }}</td>
                <td>{{ $employee->is_active ? 'Hoạt động' : 'Ngừng hoạt động' }}</td>
                <td>{{ $employee->hire_date }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-info mb-2 mt-2">Xem</a><br>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning  mb-2 mt-2">Sửa</a><br>
                    <form action="{{ route('employees.destroy', $employee) }}" class="d-inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn chắn muốn xóa không?')"
                            class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">{{ $data->links() }}</div>
@endsection
