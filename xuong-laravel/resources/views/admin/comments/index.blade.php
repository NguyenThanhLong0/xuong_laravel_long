@extends('admin.layouts.master')

@section('content')
    <h1>Danh sách bình luận theo bài viết</h1>

    @if ($comments->isEmpty())
        <p>Không có bình luận nào.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên Bài Viết</th>
                    <th>Tên Người Bình Luận</th>
                    <th>Nội Dung Bình Luận</th>
                    <th>Thời Gian</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
