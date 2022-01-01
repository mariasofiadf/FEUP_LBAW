<article class="auction" data-id="{{ $auction->id }}">
<header>
  <h2><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a></h2>

  <h3>{{ $auction->category }}</h3>

  <h3>Highest Bid: {{ $bid->bid_value }}€ by {{ $bidder->name}}</h3>
  <a href="/auctions/{{ $auction->auction_id }}/delete" class="delete">&#10761;</a>

  <form method="POST" action="{{ route('auctions/{id}/bid', $auction->auction_id) }}">
      {{ csrf_field() }}

      <label for="bid_value">Bid Value</label>
      <input id="bid_value" type="number" name="bid_value" value="{{ old('bid_value') }}" required>
      @if ($errors->has('bid_value'))
        <span class="error">
            {{ $errors->first('bid_value') }}
        </span>
      @endif

      <button type="submit">
        Bid
      </button>
  </form>
</header>

</article>

