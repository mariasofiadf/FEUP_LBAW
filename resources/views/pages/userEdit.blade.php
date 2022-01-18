@extends('layouts.app')

@section('title', "User Edit")

<title>Edit Profile</title>

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
  </ol>
</nav>
  @include('partials.userEdit',  ['user' => $user])
@endsection
