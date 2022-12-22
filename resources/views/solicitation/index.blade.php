@extends('layout')

@section('content')
<a href="{{ route('solicitation.store') }}">
    <button>Register</button>
</a>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($solicitation as $e)
        <tr>
            <td>{{ $e->title }}</td>
            <td>{{ $e->type_solicitation_name }}</td>
            <td><a href="{{ route('solicitation.update', $e->id) }}">Update</a></td>
            <td>
                <form action="{{ route('solicitation.delete', $e->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($solicitation) == 0)
        <tr>
            <td colspan="1">No registered solicitation</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $solicitation->links() }}
</div>
@endsection
