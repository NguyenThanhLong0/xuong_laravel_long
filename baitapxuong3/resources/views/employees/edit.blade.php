@extends('master')

@section('title')
    Cập nhật Employee {{ $employee->first_name }} {{ $employee->last_name }}
@endsection

@section('content')
    {{-- thông báo thành công --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    {{-- thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 mt-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="first_name" value="{{ $employee->first_name }}" 
                placeholder="Enter first name" name="first_name">
        </div>

        <div class="mb-3 mt-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" value="{{ $employee->last_name }}" 
                placeholder="Enter last name" name="last_name">
        </div>

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $employee->email }}" 
                placeholder="Enter email" name="email">
        </div>

        <div class="mb-3 mt-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control" id="phone" value="{{ $employee->phone }}" 
                placeholder="Enter phone" name="phone">
        </div>

        <div class="mb-3 mt-3">
            <label for="date_of_birth" class="form-label">Date of Birth:</label>
            <input type="date" class="form-control" id="date_of_birth" value="{{ $employee->date_of_birth }}" 
                name="date_of_birth">
        </div>

        <div class="mb-3 mt-3">
            <label for="hire_date" class="form-label">Hire Date:</label>
            <input type="datetime-local" class="form-control" id="hire_date" value="{{ $employee->hire_date }}" 
                name="hire_date">
        </div>

        <div class="mb-3 mt-3">
            <label for="salary" class="form-label">Salary:</label>
            <input type="number" class="form-control" id="salary" value="{{ $employee->salary }}" 
                placeholder="Enter salary" name="salary" step="0.01">
        </div>

        <div class="mb-3 mt-3">
            <label for="is_active" class="form-label">Active Status:</label>
            <select class="form-control" id="is_active" name="is_active">
                <option value="1" {{ $employee->is_active == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $employee->is_active == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="department_id" class="form-label">Department ID:</label>
            <input type="number" class="form-control" id="department_id" value="{{ $employee->department_id }}" 
                placeholder="Enter department ID" name="department_id">
        </div>

        <div class="mb-3 mt-3">
            <label for="manager_id" class="form-label">Manager ID:</label>
            <input type="number" class="form-control" id="manager_id" value="{{ $employee->manager_id }}" 
                placeholder="Enter manager ID" name="manager_id">
        </div>

        <div class="mb-3 mt-3">
            <label for="address" class="form-label">Address:</label>
            <textarea class="form-control" id="address" placeholder="Enter address" name="address">{{ $employee->address }}</textarea>
        </div>

        <div class="mb-5 mt-3">
            <label for="profile_picture" class="form-label">Profile Picture:</label>
            <input type="file" class="form-control mb-3" id="profile_picture" name="profile_picture">
            @if ($employee->profile_picture)
                <img src="{{ Storage::url($employee->profile_picture) }}" alt="Employee Image" width="50">
                <input type="hidden" name="profile_picture_url" value="{{ $employee->profile_picture }}">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('employees.index') }}" class="btn btn-info">Back to list</a>
    </form>
@endsection
