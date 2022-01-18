
@extends('layouts.app')
@section('content')

<title>{{$user->username}}'s profile</title>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/users">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $user->username }}</li>
  </ol>
</nav>



<article class="user" data-id="{{ $user->user_id }}">
<div class="card">
    <div class="card-body">
      <h2 class="card-title ">{{ $user->name }}</h2>
        <img width="200" height="200" src = {{ $user->profile_image }} >
      </div>
      <p class="card-text">{{ '@' . $user->username }}</p> 
      <p class="card-text">Followers: placeholder</p> 
      <p class="card-text">Description</p>
      <p class="card-text">Joined date</p>
      @if ( Auth::check() and (Auth::id() == $user->user_id or Auth::user()->is_admin))
        <div class="d-grid gap-2 d-md-block">
          <a class="btn btn-primary" href = "/profile/edit">Edit Profile</a> 
          <a class="btn btn-primary" href = "/users/{{$user->user_id}}/del">Delete Profile</a> 
          @if(!$user->is_admin and Auth::id() == $user->user_id)
            <a class="btn btn-primary" href = "/mybids">My Bidding History</a> 
          @endif
          
        </div>
      @endif
    </div>
</div>

@include('partials.rating', ['user' => $user])
@if(!$user->is_admin )
<div class="card">
    <div class="card-body">

      <h2 class="card-title "> {{ $user->name }}'s Auctions</h2>
      @include('partials.auctions', ['auctions' => $user->ownedAuctions()->get()])
    </div>
</div>
@endif
</article>

@endsection