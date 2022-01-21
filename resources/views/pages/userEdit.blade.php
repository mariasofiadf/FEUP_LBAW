@extends('layouts.app')

@section('title', "User Edit")

<title>Edit Profile</title>

@section('content')
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
      </ol>
    </nav>
    </div>
  </nav>

  @include('partials.userEdit',  ['user' => $user])

@endsection
