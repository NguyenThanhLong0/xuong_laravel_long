@extends('admin.layouts.master')

@section('title')
    Cập nhật User {{ $user->name }}
@endsection

@section('content')
    {{-- thông báo thành công --}}
    @if (session()->has('success'))
        <div class="alert alert-success"></div>
        {{ session()->get('success') }}
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" placeholder="Enter name"
                name="name">
        </div>

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Enter email"
                name="email">
        </div>

        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}"
                placeholder="Enter password" required>
        </div>

        <div class="mb-3 mt-3">
            <label for="type" class="form-label">Type:</label>
            <select class="form-control" id="type" name="type">
                <option value="1" {{ $user->type == 1 ? 'selected' : '' }}>Admin</option>
                <option value="0" {{ $user->type == 0 ? 'selected' : '' }}>Member</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-info">Back to list</a>
    </form>
@endsection
