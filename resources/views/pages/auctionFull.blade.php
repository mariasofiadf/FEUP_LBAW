@extends('layouts.app')

@section('title', $auction->name)

@section('content')
  @include('partials.auctionFull', ['auction' => $auction, 'bid' => $bid, 'bidder' => $bidder])
@endsection
