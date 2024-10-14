@extends('master')

@section('title')
    Chi tiết Sinh viên
@endsection

@section('content')
    <h1>Chi tiết Sinh viên: {{ $student->name }}</h1>

    <table class="table table-bordered">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>

        <tr>
            <td>Tên</td>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <td>Lớp học</td>
            <td>{{ $student->classroom->name ?? 'Không có lớp' }}</td>
        </tr>

        @if ($student->passport)
            <tr>
                <td>Số hộ chiếu</td>
                <td>{{ $student->passport->passport_number }}</td>
            </tr>
            <tr>
                <td>Ngày cấp</td>
                <td>{{ \Carbon\Carbon::parse($student->passport->issued_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Ngày hết hạn</td>
                <td>{{ \Carbon\Carbon::parse($student->passport->expiry_date)->format('d/m/Y') }}</td>
            </tr>
        @else
            <tr>
                <td>Thông tin hộ chiếu</td>
                <td>Không có thông tin hộ chiếu</td>
            </tr>
        @endif

        <tr>
            <td>Môn học</td>
            <td>
                @if ($student->subjects->isNotEmpty())
                    {{ implode(', ', $student->subjects->pluck('name')->toArray()) }}
                @else
                    Chưa đăng ký môn học
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('students.index') }}" class="btn btn-info">Quay lại danh sách</a>
@endsection
