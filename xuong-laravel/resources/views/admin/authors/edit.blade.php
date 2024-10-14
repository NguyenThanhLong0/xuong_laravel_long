@extends('admin.layouts.master')

@section('title')
    Sửa thông tin tác giả
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Chỉnh sửa thông tin tác giả</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <form action="{{ route('admin.authors.update', $author->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên tác giả</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $author->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            <img src="{{ Storage::url($author->avatar) }}" alt="{{ $author->name }}" width="150px"
                                class="mt-2">
                            @error('avatar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
