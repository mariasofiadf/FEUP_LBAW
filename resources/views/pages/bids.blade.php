@extends('layouts.app')

@section('title', 'My Bidding History')

@section('content')


<title>My Bidding History</title>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">My Bids</li>
  </ol>
</nav>
    </div>
  </nav>


<h2> My Bidding History</h2>
<div class="container " style="margin: 1rem;">
    @each('partials.userBid', $bids, 'bid')
</div>

@endsection
