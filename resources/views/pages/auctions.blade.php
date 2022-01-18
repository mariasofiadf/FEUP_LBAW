@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

<title>Auctions</title>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Auctions</li>
  </ol>
</nav>


@include('partials.searchAuctions')

@include('partials.auctions', ['auctions' => $auctions])


@endsection
