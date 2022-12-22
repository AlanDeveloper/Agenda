@extends('layout')

@section('content')
<form action="{{ route('solicitation.update',$solicitation->id) }}" method="post" id="formCreateOrUpdate">
    @csrf
    @method('put')
    <h1>Register Employee</h1>
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $solicitation->title }}">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10">{{ $solicitation->description }}</textarea>
    </div>
    <div>
        <label for="type_id">Company:</label>
        <select name="type_id" id="type_id">
            <option value="">Select</option>
            @foreach ($type_solicitation as $c)
            <option value="{{ $c->id }}" @if ($c->id ==$solicitation->type_id) selected @endif>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" value="Send">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
