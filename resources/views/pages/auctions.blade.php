@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

<section id="auctions">
  @each('partials.auction', $auctions, 'auction')
  <article class="auction">    
    <form method="POST" action="{{ route('api/auctions') }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}" required autofocus>
        @if ($errors->has('title'))
          <span class="error">
              {{ $errors->first('title') }}
          </span>
        @endif

        <label for="min_opening_bid">Minimum Opening Bid</label>
        <input id="min_opening_bid" type="number" name="min_opening_bid" value="{{ old('min_opening_bid') }}" required autofocus>
        @if ($errors->has('min_opening_bid'))
          <span class="error">
              {{ $errors->first('min_opening_bid') }}
          </span>
        @endif

        <label for="min_raise">Minimum Raise</label>
        <input id="min_raise" type="number" name="min_raise" value="{{ old('min_raise') }}" required>
        @if ($errors->has('min_raise'))
          <span class="error">
              {{ $errors->first('min_raise') }}
          </span>
        @endif

        <label for="auction_category">Category</label>
        <input list = "auction_categories" id="auction_category" type="text" name="auction_category" required>
          <datalist id="auction_categories">
            <option value="ArtPiece">
            <option value="Book">
            <option value="Jewelry">
            <option value="Decor">
            <option value="Other">
          </datalist>
        @if ($errors->has('auction_category'))
          <span class="error">
              {{ $errors->first('auction_category') }}
          </span>
        @endif

        <label for="auction_status">Status</label>
        <input list = "auction_statuss" id="auction_status" type="text" name="auction_status" required>
          <datalist id="auction_statuss">
            <option value="Active">
            <option value="Hidden">
            <option value="Canceled">
            <option value="Closed">
          </datalist>
        @if ($errors->has('auction_status'))
          <span class="error">
              {{ $errors->first('auction_status') }}
          </span>
        @endif
        <button type="submit">
          Submit
        </button>
    </form>
  </article>
</section>

@endsection
