@extends('layout')

@section('content')
<form action="{{ route('type_solicitation.update', $type_solicitation->id) }}" method="post" id="formCreateOrUpdate">
    @csrf
    @method('put')
    <h1>Update Company</h1>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $type_solicitation->name }}">
    </div>
    <input type="submit" value="Send">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
