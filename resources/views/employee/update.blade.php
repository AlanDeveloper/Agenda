@extends('layout')

@section('content')
<form action="{{ route('employee.update', $employee->id) }}" method="post" id="formCreateOrUpdate">
    @csrf
    @method('put')
    <h1>Register Employee</h1>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $employee->name }}">
    </div>
    <div>
        <label for="company_id">Company:</label>
        <select name="company_id" id="company_id">
            <option value="">Select</option>
            @foreach ($company as $c)
            <option value="{{ $c->id }}" @if ($c->id == $employee->company_id) selected @endif>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" value="Send">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
