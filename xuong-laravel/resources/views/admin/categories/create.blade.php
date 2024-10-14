@extends('admin.layouts.master')

@section('title')
    Thêm mới danh mục
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <h3>Thêm mới danh mục</h3>
                </div>
                <div class="white_card_body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
