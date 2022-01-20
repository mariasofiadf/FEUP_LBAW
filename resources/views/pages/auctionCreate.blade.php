@extends('layouts.app')

@section('title', "Auction Creation")

@section('content')
<div class = "container">
  <title>Auction Creation</title>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/auctions">Auctions</a></li>
      <li class="breadcrumb-item active" aria-current="page">Auction Creation</li>
    </ol>
  </nav>
    </div>
  </nav>


  @include('partials.auctionCreate')
</div>
 
  
@endsection
