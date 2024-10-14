@extends('master')

@section('title')
    <h1>Tạo mới học sinh</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>

        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>

        </div>
        <div class="mb-3">
            <label for="classroom_id" class="form-label">Lớp học:</label>
            <select class="form-select" id="classroom_id" name="classroom_id" required>
                <option value="">Chọn lớp học</option>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>

        </div>
        <div class="mb-3">
            <label for="passport_number" class="form-label">Số hộ chiếu:</label>
            <input type="text" class="form-control" id="passport_number" name="passport_number"
                value="{{ old('passport_number') }}" required>
        </div>

        <div class="mb-3">
            <label for="issued_date" class="form-label">Ngày cấp:</label>
            <input type="date" class="form-control" id="issued_date" name="issued_date" value="{{ old('issued_date') }}"
                required>
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Ngày hết hạn:</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}"
                required>
        </div>

        <div class="mb-3">
            <label for="subjects" class="form-label">Môn học:</label>
            <select class="form-select" id="subjects" name="subjects[]" multiple required>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>

        </div>
        <button type="submit" class="btn btn-primary">Tạo mới</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
