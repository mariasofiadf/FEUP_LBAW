@extends('layouts.app')

@section('content')
<div class="card sm align-middle" style="width: auto; margin-right: 1rem;">
<div class="card-body">
<form method="POST" action="{{ route('login') }}">

  {{ csrf_field() }}
  @include('partials.errorsuccess')
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
</form>
  </div>
</div>
@endsection
