
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@extends('layouts.app')
@section('content')


<title>{{$user->username}}'s profile</title>

<article class="user" data-id="{{ $user->user_id }}">



<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="./users">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $user->username }}</li>
  </ol>
</nav>
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">   
    <div id="pad-wrapper">
        <div class="col-md-4"  style=" border: 1px solid #d8d8d8; ">
        <div class="panel panel-default">
        <div class="panel-heading"><strong>Details</strong></div>
        <div class="user-profile">
            <div class="user-avatar">
                <img alt="image" class="img-profile" src="{{ $user->profile_image }}">
            </div>
            <div class="ibox-content profile-content">
                <h3><strong>{{ $user->name }}</strong></h3>
                <p><i class="fa fa-map-marker"></i> @ {{ $user->username }}</p>
                <h5><strong>About me</strong></h5>                
                <p>I think we should had an about section.</p>

                    @if ( Auth::check() and (Auth::id() == $user->user_id or Auth::user()->is_admin))
                          <div class="d-grid gap-2 d-md-block">
                            <a class="btn btn-primary" href = "/profile/edit">Edit Profile</a> 
                            <a class="btn btn-primary" href = "/users/{{$user->user_id}}/del">Delete Profile</a> 
                            @if(!$user->is_admin and Auth::id() == $user->user_id)
                              <a class="btn btn-primary" href = "/mybids">My Bidding History</a> 
                            @endif
                            
                          </div>
                        
                        @endif
                    @if ( Auth::check() and (Auth::id() == $user->user_id or Auth::user()->is_admin))
                    <div class="d-flex flex-column">
                        <span class=" text-center mb-5">Total rating: {{ $user->rating }}</span>
                    </div>
                    @else
                    <div class="row">
                        @include('partials.rating', ['user' => $user])
                      </div>
                    @endif

            </div><!-- /profile-content -->
        </div>
       
        </div>
        
        </div>
  
  </div>


</div>

  @if(!$user->is_admin )
        <div class="card">
            <div class="card-body">
              <h2 class="card-title "> {{ $user->name }}'s Auctions</h2>
              @include('partials.auctions', ['auctions' => $user->ownedAuctions()->get()])
            </div>
        </div>
  @endif 
@endsection

</article>