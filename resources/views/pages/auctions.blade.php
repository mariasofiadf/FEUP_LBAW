@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

<section id="auctions">
  @each('partials.auction', $auctions, 'auction')
  <article class="auction">
    <form class="new_auction">
      <input type="text" name="name" placeholder="new auction">
    </form>
  </article>
</section>

@endsection
