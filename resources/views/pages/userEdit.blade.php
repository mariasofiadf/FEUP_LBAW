@extends('layouts.app')

@section('title', "User Edit")

<title>Edit Profile</title>

@section('content')
  @include('partials.userEdit',  ['user' => $user])
@endsection
