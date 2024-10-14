@extends('admin.layouts.master')

@section('title')
    Chi tiết tác giả
@endsection

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>

        @foreach ($author->toArray() as $field => $value)
            <tr>
                <td>{{ $field }}</td>
                <td>
                    @if ($field == 'avatar' && $value)
                        <img src="{{ asset('storage/' . $value) }}" alt="{{ $author->name }}" width="100px">
                    @else
                        {!! $value !!}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('admin.authors.index') }}" class="btn btn-info">Quay lại danh sách</a>
@endsection
