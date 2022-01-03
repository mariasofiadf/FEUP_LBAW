<div class="card">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h2 class="card-title"><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a> by <a href="/users/{{ $auction->seller_id }}">{{ $user->name }}</a></h2>
    <p class="card-text">{{ $auction->description ?? '' }}</p>
    <p class="card-text">Category: {{ $auction->category }}</p>
    @if ($bid != null)
      <p class="card-text">Current highest bid is {{ $bid->bid_value ?? 0}}€ by {{ $bidder->name ?? ''}}</p>
    @else 
      <p class="card-text">This auction has no bids</p>
      <p class="card-text">Minimum opening bid is  {{ $auction->min_opening_bid ?? 0}}€ </p>
    @endif



    @if ( (Auth::check() && Auth::id() == $auction->seller_id ) or (Auth::check() && Auth::user()->is_admin))
      <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-secondary">Delete</a>
      <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn btn-secondary">Edit</a>
    @else
      <form  method="POST" action="{{ route('auctions/{id}/bid', $auction->auction_id) }}">
      {{ csrf_field() }}

      <div class="row">
      <div class="col-1">
        <label for="bid_value" class="form-label">Bid Value</label>
      </div>
      <div class="col-1">
        <input type="number" name="bid_value" class="form-control" id="bid_value" aria-describedby="emailHelp">
      </div>
      <div class="col-1">
        <button type="submit" class="btn btn-primary">Bid</button>
      </div>
      </div>
      </form>
    @endif
  </div>
</div>

