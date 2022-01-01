
@extends('layouts.app')
@section('content')


    <section class = "profile-section">
      <div >
        <div class="profile-container">
            <div class=" ">
              <h2 class="fw-bold">{{ $user->name }}</h2>
              <div class="fst-italic mb-2">{{ '@' . $user->username }}</div> 
            
              <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number">1069 <span class="follow">Followers</span></span> </div>
              @if (Auth::check() && Auth::id() != $user->id )
              <button class="edit-prof-btn " href = "/users/{{ Auth::user()->user_id }}/edit">Edit Profile</button> 
              @endif
              <div class="text mt-3"> <span>Description</span> </div>
              <div class=" joined text"> <span class="join">Joined May,2021</span> </div>

            </div>
        </div>
      </div>
    </section>


@endsection