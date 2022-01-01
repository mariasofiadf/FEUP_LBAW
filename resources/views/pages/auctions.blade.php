@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

<section id="auctions">
  @each('partials.auctionPreview', $auctions, 'auction')
  <a href="create">
   <button>Create Auction</button>
  </a>

</section>

@endsection
