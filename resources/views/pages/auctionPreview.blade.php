@extends('layouts.app')

@section('title', $auction->name)

@section('content')
  @include('partials.auctionPreview', ['auction' => $auction, 'bid' => $bid, 'user' => $user])
@endsection
