@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<title>Notifications</title>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
      </ol>
    </nav>

    </div>
  </nav>


<h2> My Notifications</h2>
<div class="container-fluid " style="margin: 1rem; width: max">
    @each('partials.userNotification', $notifs, 'notif')
</div>


@endsection
