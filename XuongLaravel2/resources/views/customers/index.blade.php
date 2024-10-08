@extends('master')

@section('title')
    Trang danh sách customers
@endsection

@section('content')
    {{-- @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success')->get('success') }}
        </div>
    @endif --}}
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Thêm mới</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Is_active</th>
            <th>Action</th>
        </tr>

        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td><img src="{{ Storage::url($customer->image) }}" alt="" width="100"></td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->is_active }}</td>
                <td>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">{{ $customers->links() }}</div>
@endsection
