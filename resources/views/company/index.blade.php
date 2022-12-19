@extends('layout')

@section('content')
<a href="{{ route('company.store') }}">
    <button>Register</button>
</a>
@if (session('status'))
    <p>{{ session('status') }}</p>
@endif
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($company as $c)
        <tr>
            <td>{{ $c->name }}</td>
            <td><a href="{{ route('company.update', $c->id) }}">Update</a></td>
            <td>
                <form action="{{ route('company.delete', $c->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($company) == 0)
        <tr>
            <td colspan="1">No registered company</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $company->links() }}
</div>
@endsection
