@extends('layout')

@section('content')
<form action="{{ route('company.store') }}" method="post" id="formCreateOrUpdate">
    @csrf
    <h1>Register Company</h1>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
    </div>
    <input type="submit" value="Send">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
