@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">

    {{ csrf_field() }}
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
  </div>
  <div class="password">
    <label for="password" class="form-label">Password</label>
    <input type="password" name= "password" class="form-control" id="password">

  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
  <a class="btn btn-secondary" href="{{ route('register') }}"> Register </a>
</form>
@endsection
