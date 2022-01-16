@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notifications</li>
  </ol>
</nav>


<h2> My Notifications</h2>
<div class="container-fluid " style="margin: 1rem; width: max">
    @each('partials.auctionNotification', $anotifs, 'notif')

    @each('partials.userNotification', $unotifs, 'notif')
</div>


@endsection
