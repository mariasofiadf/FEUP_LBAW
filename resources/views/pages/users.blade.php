@extends('layouts.app')

@section('title', 'Users')

@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
  </ol>
</nav>

@include('partials.searchUsers')

@include('partials.users', ['users' => $users])

@endsection
