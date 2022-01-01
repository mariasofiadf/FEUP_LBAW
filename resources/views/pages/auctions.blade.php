@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

<section id="auctions">
  @each('partials.auction', $auctions, 'auction')
  <a href="create">
   <button>Create Auction</button>
  </a>

</section>

@endsection
