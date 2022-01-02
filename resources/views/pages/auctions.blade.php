@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

<section class = "container-fluid">
  @each('partials.auctionPreview', $auctions, 'auction')

  <a href="create" class="btn btn-primary">Create Auction</a>

</section>

@endsection
