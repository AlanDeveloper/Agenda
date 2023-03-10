@extends('layout')

@section('content')
<a href="{{ route('employee.store') }}">
    <button>Register</button>
</a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Company</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee as $e)
        <tr>
            <td>{{ $e->name }}</td>
            <td>{{ $e->company_name }}</td>
            <td><a href="{{ route('employee.schedule', $e->id) }}">View schedule</a></td>
            <td><a href="{{ route('employee.update', $e->id) }}">Update</a></td>
            <td>
                <form action="{{ route('employee.delete', $e->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($employee) == 0)
        <tr>
            <td colspan="1">No registered employee</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $employee->links() }}
</div>
@endsection
