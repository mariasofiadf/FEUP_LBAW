@extends('layouts.app')

@section('title', $auction->name)

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="/auctions">Auctions</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $auction->title }}</li>
  </ol>
</nav>

@include('partials.errorsuccess')
<article class="auction" data-id="{{ $auction->auction_id }}">
@section('content')
  @include('partials.auctionFull', ['auction' => $auction])


<h2>Bidding History</h2>
@include('partials.bids', ['bids' => $bids])

</article>
@endsection

