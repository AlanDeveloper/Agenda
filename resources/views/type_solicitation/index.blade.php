@extends('layout')

@section('content')
<a href="{{ route('type_solicitation.store') }}">
    <button>Register</button>
</a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($type_solicitation as $c)
        <tr>
            <td>{{ $c->name }}</td>
            <td><a href="{{ route('type_solicitation.update', $c->id) }}">Update</a></td>
            <td>
                <form action="{{ route('type_solicitation.delete', $c->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($type_solicitation) == 0)
        <tr>
            <td colspan="1">No registered type</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $type_solicitation->links() }}
</div>
@endsection
