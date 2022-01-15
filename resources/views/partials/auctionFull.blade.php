<div class="card">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h2 class="card-title"><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a> by <a href="/users/{{ $auction->seller_id }}">{{ $auction->owner()->first()->name }}</a></h2>
    <p class="card-text">Auction closes at: {{ $auction->close_date }}</p>
    <p class="card-text">{{ $auction->description ?? '' }}</p>
    <p class="card-text">Category: {{ $auction->category }} {{$auction->win_bid}}</p>
    <p></p>
    @if ($bids->first() != null && $auction->status == 'Active')
      <p class="card-text">Current highest bid is {{ $bids->first()->bid_value ?? 0}}€ by {{ $bids->first()->bidder()->first()->name ?? ''}}</p>
      <p class="card-text">Minimum raise is  {{ $auction->min_raise ?? 0}}€ </p>
    @elseif ($auction->status == 'Active')
      <p class="card-text">This auction has no bids</p>
      <p class="card-text">Minimum opening bid is  {{ $auction->min_opening_bid ?? 0}}€ </p>
    @else
    <div class="alert alert-info card-text" role="alert">This auction has ended. The winning bid was  {{ $bid->bid_value ?? 0}}€ by {{$winner->name ?? 'null'}}</div>
    @endif


    @if ( (Auth::check() && Auth::id() == $auction->seller_id ) or (Auth::check() && Auth::user()->is_admin))
      <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-secondary">Delete</a>
      <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn btn-secondary">Edit</a>
      <a href="/reportAuction/{{ $auction->auction_id }}" class = "btn btn-secondary">Report</a>
    @elseif(Auth::check() or (Auth::check() && Auth::user()->is_admin))
      <a href="/reportAuction/{{ $auction->auction_id }}" class = "btn btn-secondary">Report</a>
    @elseif(Auth::check() && Auth::user()->is_admin)
      <a href="/auctionComplaints" class = "btn btn-secondary">Check Complaints</a>
    @elseif (Auth::check() && $auction->status == 'Active')
      <form  method="POST" action="{{ route('auctions/{id}/bid', $auction->auction_id) }}">
      {{ csrf_field() }}

      <div class="row">
      <div class="col-1">
        <label for="bid_value" class="form-label">Bid Value</label>
      </div>
      <div class="col-3">
        <input type="number" name="bid_value" class="form-control" id="bid_value" aria-describedby="emailHelp">
      </div>
      <div class="col-1">
        <button type="submit" class="btn btn-primary">Bid</button>
      </div>
      </div>
      </form>
    @elseif ($auction->status == 'Active')
      <a href="/login" class="btn btn-primary">Login to Bid on this Auction</a> 
    @endif
  </div>
</div>


