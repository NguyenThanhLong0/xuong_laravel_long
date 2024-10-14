@extends('master')

@section('title')
    <h1>Danh sách sinh viên</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a class="btn btn-primary mb-3" href="{{ route('students.create') }}">Thêm Sinh viên</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Lớp</th>
            <th>Số hộ chiếu</th>
            <th>Hành động</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->classroom->name }}</td>
                <td>{{ $student->passport->passport_number ?? 'Không có hộ chiếu' }}</td>
                <td>
                    <a class="btn btn-info mb-2" href="{{ route('students.show', $student->id) }}">Chi tiết</a><br>
                    <a class="btn btn-warning mb-2" href="{{ route('students.edit', $student->id) }}">Chỉnh sửa</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mb-2"
                            onclick="return confirm('Bạn có chắc chắn chắn muốn xóa không?')" type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="flex justify-center">{{ $students->links() }}</div>
@endsection
