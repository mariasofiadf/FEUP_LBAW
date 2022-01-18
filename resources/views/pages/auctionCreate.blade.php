@extends('layouts.app')

@section('title', "Auction Creation")

@section('content')

  <title>Auction Creation</title>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/auctions">Auctions</a></li>
      <li class="breadcrumb-item active" aria-current="page">Auction Creation</li>
    </ol>
  </nav>

  @include('partials.auctionCreate')
  
@endsection
