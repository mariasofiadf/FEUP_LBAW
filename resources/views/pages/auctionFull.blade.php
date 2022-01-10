@extends('layouts.app')

@section('title', $auction->name)

@section('content')
  @include('partials.auctionFull', ['auction' => $auction, 'bid' => $bid, 'bidder' => $bidder, 'user' => $user, 'winner' => $winner])


<h2>Bidding History</h2>
@include('partials.bids', ['bids' => $bids])
@endsection

