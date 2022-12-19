@extends('layout')

@section('content')
<form action="{{ route('employee.store') }}" method="post" id="formCreateOrUpdate">
    @csrf
    <h1>Register Employee</h1>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
    </div>
    <div>
        <label for="company_id">Company:</label>
        <select name="company_id" id="company_id">
            <option value="">Select</option>
            @foreach ($company as $c)
            <option value="{{ $c->id }}" @if (old('company_id') == $c->id) selected @endif>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" value="Send">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
