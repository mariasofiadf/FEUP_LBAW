<div class="card">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h2 class="card-title"><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a></h2>
    <p class="card-text">Category: {{ $auction->category }}</p>
    <p class="card-text">Highest Bid: {{ $bid->bid_value }}€ by {{ $bidder->name}}</p>
    <form method="POST" action="{{ route('auctions/{id}/bid', $auction->auction_id) }}">

      {{ csrf_field() }}
      <div class="mb-3">
        <label for="bid_value" class="form-label">Bid Value</label>
        <input type="number" name="bid_value" class="form-control" id="bid_value" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Bid</button>
  </form>

  <a href="/auctions/{{ $auction->auction_id }}/delete" class="delete">Delete</a>
  </div>
</div>

