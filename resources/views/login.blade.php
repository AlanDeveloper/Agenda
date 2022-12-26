@extends('layout')

@section('content')
<form method="POST" id="formCreateOrUpdate">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <input type="submit" value="Send">
</form>
@endsection
