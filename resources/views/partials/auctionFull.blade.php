
<div class="card">
  
  <div class="card-body">
    <h2 class="card-title"><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a> by <a href="/users/{{ $auction->seller_id }}">{{ $auction->owner()->first()->name }}</a></h2>
    <img class="card-img-top" style="max-width:20%;" alt="{{$auction->auction_image}}" src="/storage/uploads/{{ $auction->auction_image }}">
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
    <div class="follow">
    @if (!Auth::user()->auctionFollows()->where('id_followed',$auction->auction_id)->where('id_follower', Auth::user()->user_id)->first())
      <a class="btn btn-primary follow" id="follow">Follow</a>
    @else
      <a class="btn btn-primary unfollow" id="follow">Unfollow</a>
    @endif
    <div>
    <!-- <a class="btn btn-primary unfollow">Unfollow</a> -->

    @if ( (Auth::check() && Auth::id() == $auction->seller_id ) or (Auth::check() && Auth::user()->is_admin))
      <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-secondary">Delete</a>
      <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn btn-secondary">Edit</a>
    @elseif (Auth::check() && $auction->status == 'Active')
      <form class="new_bid">
        <div class="row">
          <div class="col-1">
            <label for="bid_value" class="form-label">Bid Value</label>
          </div>
          <div class="col-3">
            <input type="number" name="bid_value" class="form-control" id="bid_value" min={{$bids->first()->bid_value + $auction->min_raise ?? $auction->min_opening_bid }} aria-describedby="emailHelp">
          </div>
          <!-- <div class="col-1">
            <button class="btn btn-primary submit_bid">Bid</button>
          </div> -->
        </div>
      </form>
    @elseif ($auction->status == 'Active')
      <a href="/login" class="btn btn-primary">Login to Bid on this Auction</a> 
    @endif
  </div>


</div>


