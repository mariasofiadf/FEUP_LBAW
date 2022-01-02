
@extends('layouts.app')
@section('content')



<div class="card">
    <div class="card-body">
      <h2 class="card-title ">{{ $user->name }}</h2>
      <p class="card-text">{{ '@' . $user->username }}</p> 
      <p class="card-text">Followers: placeholder</p> 
      <p class="card-text">Description</p>
      <p class="card-text">Joined date</p>
      @if (Auth::check() && Auth::id() != $user->id )
      <button class="btn btn-primary" href = "/users/{{ Auth::user()->user_id }}/edit">Edit Profile</button> 
      @endif
    </div>
</div>



@endsection