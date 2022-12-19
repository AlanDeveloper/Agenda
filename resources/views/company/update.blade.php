@extends('layout')

@section('content')
<form action="{{ route('company.update', $company->id) }}" method="post" id="formCreateOrUpdate">
    @csrf
    @method('put')
    <h1>Update Company</h1>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $company->name }}">
    </div>
    <input type="submit" value="Send">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
