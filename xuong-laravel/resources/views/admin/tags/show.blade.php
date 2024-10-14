@extends('admin.layouts.master')

@section('title')
    Chi tiết Tag
@endsection

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>

        @foreach ($tag->toArray() as $field => $value)
            <tr>
                <td>{{ $field }}</td>
                <td>{!! $value !!}</td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('admin.tags.index') }}" class="btn btn-info">Quay lại danh sách</a>
@endsection
