@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Thông Tin Cá Nhân</h1>
        <form>
            <div class="form-group">
                <label for="name">Họ Tên</label>
                <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="role">Vai Trò</label>
                <input type="text" class="form-control" id="role" value="{{ Auth::user()->role }}" readonly>
            </div>
        </form>
    </div>
@endsection
