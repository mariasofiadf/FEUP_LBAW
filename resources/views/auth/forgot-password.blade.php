@extends('layouts.app')

@section('content')
<div class="card sm align-middle" style="width: auto; margin-right: 1rem;">
<div class="card-body">
<form method="POST" action="{{ url('forgot-password') }}">

    {{ csrf_field() }}
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-primary">Get password reset link</button>
</form>
  </div>
</div>
@endsection
