@extends('master')

@section('title')
    Chi tiết Employee
@endsection

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>

        @foreach ($employee->toArray() as $field => $value)
            <tr>
                <td>{{ $field }}</td>
                <td>
                    @php
                        switch ($field) {
                            case 'profile_picture':
                                $url = \Storage::url($employee->profile_picture);
                                echo "<img src=\"$url\" width=\"50px\" alt=\"\">";
                                break;

                            default:
                                echo $value;
                                break;
                        }
                    @endphp
                </td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('employees.index') }}" class="btn btn-info">Back to list</a>
@endsection
