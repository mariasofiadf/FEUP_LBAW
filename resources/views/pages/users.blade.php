@extends('layouts.app')

@section('title', 'Users')

@section('content')

<title>Users</title>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
      </nav>
    </div>
  </nav>



@include('partials.searchUsers')

@include('partials.users', ['users' => $users])

@endsection
