@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Chào mừng đến với Dashboard!</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
    </div>
@endsection
