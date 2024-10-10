@extends('admin.layouts.master')

@section('title')
    Thêm mới User
@endsection

@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- chống error --}}
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>

                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>

                <div class="mb-3 mt-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>

                <div class="mb-3 mt-3">
                    <label for="type" class="form-label">Type:</label>
                    <select class="form-control" id="type" name="type">
                        <option value="1">Admin</option>
                        <option value="0">Member</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5">Submit</button>
    </form>
@endsection
