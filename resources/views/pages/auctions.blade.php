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

        <label for="min_raise">Minimum Rais</label>
        <input id="min_raise" type="min_raise" name="min_raise" value="{{ old('min_raise') }}" required>
        @if ($errors->has('min_raise'))
          <span class="error">
              {{ $errors->first('min_raise') }}
          </span>
        @endif

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @if ($errors->has('password'))
          <span class="error">
              {{ $errors->first('password') }}
          </span>
        @endif

        <button type="submit">
          Submit
        </button>
    </form>
  </article>
</section>

@endsection
