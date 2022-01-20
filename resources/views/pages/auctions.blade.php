@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

<title>Auctions</title>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Auctions</li>
  </ol>
</nav>


@include('partials.searchAuctions')

@if (Auth::check() and !Auth::user()->is_admin)
<div class = "text-center">
<a href="/create" class="btn btn-primary">Create Auction</a>
</div>

@endif


@include('partials.auctions', ['auctions' => $auctions])


@endsection
