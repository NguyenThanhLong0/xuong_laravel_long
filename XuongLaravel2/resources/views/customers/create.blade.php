@extends('master')

@section('title')
    Trang chỉnh sửa customers
@endsection

@section('content')
    {{-- @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif --}}
    {{-- thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>

        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="">Phone</label>
            <input type="tel" class="form-control" name="phone" id="phone">
        </div>

        <div class="form-group"></div>
        <label for="">Address</label>
        <input type="text" class="form-control" name="address" id="address">
        </div>

        <div class="form-group">
            <label for="">Is_active</label>
            <select name="is_active" id="is_active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
