
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
    @elseif (is_null($bids->first()))
    <div class="alert alert-info card-text" role="alert">This auction has ended with no bids</div>
    @else
    <div class="alert alert-info card-text" role="alert">This auction has ended. The winning bid was  {{ $bids->first()->bid_value ?? 0}}€ by {{$winner->name ?? 'null'}}</div>
    @endif
    <div class="follow">
    @if (Auth::check() && !Auth::user()->auctionFollows()->where('id_followed',$auction->auction_id)->where('id_follower', Auth::user()->user_id)->first())
      <a class="btn btn-primary follow" id="follow">Follow</a>
    @elseif (Auth::check()) 
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
            @if (is_null($bids->first()))
            <input type="number" name="bid_value" class="form-control" id="bid_value" min={{ $auction->min_opening_bid }} aria-describedby="emailHelp">
            @else
            <input type="number" name="bid_value" class="form-control" id="bid_value" min={{ $bids->first()->bid_value + $auction->min_raise }} aria-describedby="emailHelp">    
            @endif
          </div>
          <div class="col-1">
            <button type="submit" class="btn btn-primary submit_bid">Bid</button>
          </div>
        </div>
      </form>
    @elseif ($auction->status == 'Active')
      <a href="/login" class="btn btn-primary">Login to Bid on this Auction</a> 
    @endif
  </div>


</div>


<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="https://i.imgur.com/Dhebu4F.jpg" width="250" /> </div>
                            <div class="thumbnail text-center"> <img onclick="change_image(this)" src="https://i.imgur.com/Rx7uKd0.jpg" width="70"> <img onclick="change_image(this)" src="https://i.imgur.com/Dhebu4F.jpg" width="70"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div> <i class="fa fa-shopping-cart text-muted"></i>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">Orianz</span>
                                <h5 class="text-uppercase">Men's slim fit t-shirt</h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price">$20</span>
                                    <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span> </div>
                                </div>
                            </div>
                            <p class="about">Shop from a wide range of t-shirt from orianz. Pefect for your everyday use, you could pair it with a stylish pair of jeans or trousers complete the look.</p>
                            <div class="sizes mt-5">
                                <h6 class="text-uppercase">Size</h6> <label class="radio"> <input type="radio" name="size" value="S" checked> <span>S</span> </label> <label class="radio"> <input type="radio" name="size" value="M"> <span>M</span> </label> <label class="radio"> <input type="radio" name="size" value="L"> <span>L</span> </label> <label class="radio"> <input type="radio" name="size" value="XL"> <span>XL</span> </label> <label class="radio"> <input type="radio" name="size" value="XXL"> <span>XXL</span> </label>
                            </div>
                            <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


