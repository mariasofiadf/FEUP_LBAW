
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@extends('layouts.app')
@section('content')


<title>{{$user->username}}'s profile</title>

<!--




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
</div>-->

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="./users">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $user->username }}</li>
        </ol>
      </nav>
    </div>
  </nav>

<div class="container-fluid w-75 mt-1 border" style= "height: 60%">
  <div class="row">
    <div class="col-auto d-flex flex-row p-3">
      <img src="{{ $user->profile_image }}" alt="Generic Profile Picture" class="mb-3 rounded-circle align-self-left" style="object-fit: cover; width: 300px; height: 300px;">
      <div class="info w-100 px-3">
          <span class="d-inline-flex align-items-center justify-content-between w-100">
              <div class="d-flex flex-column align-items-left">
                  <h1>{{ $user->name }}</h1>
                  <h3>@ {{ $user->username }}</h3>
              </div>
          </span><p></p>
          <p> <a href="#scrollspyHeading1">See Auctions</a></p> 
          @if ( Auth::check() and (Auth::id() == $user->user_id or Auth::user()->is_admin))
                <div class="d-grid d-md-block">
                <a class="btn btn-primary" href = "/profile/edit">Edit Profile</a> 
                  <a class="btn btn-primary" href = "/users/{{$user->user_id}}/del">Delete Profile</a> 
                  @if(!$user->is_admin and Auth::id() == $user->user_id)
                    <a class="btn btn-primary" href = "/mybids">My Bidding History</a> 
                  @endif
                  
                </div>
              @endif
          @if ( Auth::check() and (Auth::id() == $user->user_id or Auth::user()->is_admin))
          @elseif(Auth::check() )
              @include('partials.rating', ['user' => $user])
          @endif             
      </div>
     </div>
  </div>
 </div>


<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
  <h4 id="scrollspyHeading1">
      <div class = "container text-center m-5 pb-5">
    @if(!$user->is_admin )
      <h2 class="card-title "> {{ $user->name }}'s Auctions</h2>
      @include('partials.usersAuctions', ['auctions' => $user->ownedAuctions()->get()])
    @endif
    </div>
  </h4>
</div>




@endsection