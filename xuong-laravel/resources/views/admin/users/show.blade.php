@extends('admin.layouts.master')

@section('title')
    Chi tiết User
@endsection

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>Trường</th>
            <th>value</th>
        </tr>

        @foreach ($user->toArray() as $field => $value)
            <tr>
                <td>{{ $field }}</td>
                <td>{!! $value !!}</td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('admin.users.index') }}" class="btn btn-info">Back to list</a>
@endsection
