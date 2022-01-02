
@extends('layouts.app')
@section('content')



<div class="card">
    <div class="card-body">
      <h2 class="card-title ">{{ $user->name }}</h2>
      <p class="card-text">{{ '@' . $user->username }}</p> 
      <p class="card-text">Followers: placeholder</p> 
      <p class="card-text">Description</p>
      <p class="card-text">Joined date</p>
      @if (Auth::id() == $user->user_id )
        <a class="btn btn-primary" href = "/profile/edit">Edit Profile</a> 
        <a class="btn btn-primary" href = "/mybids">My Bidding History</a> 
      @endif
    </div>
</div>
<div class="card">
    <div class="card-body">

      <h2 class="card-title "> My Auctions</h2>
      @include('partials.auctions', ['auctions' => $auctions])
    </div>
</div>

@endsection