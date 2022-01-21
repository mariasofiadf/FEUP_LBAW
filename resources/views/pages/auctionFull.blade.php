@extends('layouts.app')

@section('title', $auction->name)


@section('content')

  <title>{{$auction->title}}</title>

  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/auctions">Auctions</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $auction->title }}</li>
        </ol>
      </nav>
    </div>
  </nav>

  @include('partials.errorsuccess')
  <article class="auction" data-id="{{ $auction->auction_id }}">
  @include('partials.auctionFull', ['auction' => $auction])




</article>
@endsection

