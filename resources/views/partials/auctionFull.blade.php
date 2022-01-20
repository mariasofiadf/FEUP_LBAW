


<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">                    
                      <img class="main-image p-3" style="width: 100%; height:100%; object-fit: cover;" alt="{{$auction->auction_image}}" src="/storage/uploads/{{ $auction->auction_image }}">
                      
                    </div>
                    <div class="col-md-6 ">
                        <div class="pull-right text-end p-3">
                        @if (Auth::check() && !Auth::user()->auctionFollows()->where('id_followed',$auction->auction_id)->where('id_follower', Auth::user()->user_id)->first())
                            <div class="align-items-center"> 
                              <a class="btn  btn-outline-primary follow" id="follow">Follow</a>
                            </div>
                            @elseif (Auth::check()) 
                            <div class="align-items-center"> 
                              <a class="btn  btn-outline-primary unfollow" id="follow">Unfollow</a>
                            </div> 
                            @endif
                        </div>
                        <div class="product p-4">
                          
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> 
                                   {{ $auction->owner()->first()->name }}
                                   </div>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">{{ $auction->category }} {{$auction->win_bid}}</span>
                                <h3 class="text-uppercase pb-4">{{ $auction->title }}</h3>
                            </div>
                            <p class="about">{{ $auction->description ?? '' }}</p>
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
                            <p></p>
                              @if ( (Auth::check() && Auth::id() == $auction->seller_id ) or (Auth::check() && Auth::user()->is_admin))
                                <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-secondary">Delete</a>
                                <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn btn-secondary">Edit</a>
                              @elseif (Auth::check() && $auction->status == 'Active')
                                <form class="new_bid  pt-5">
                                  <div class="row">
                                    <div class="col-5">
                                      @if (is_null($bids->first()))
                                      <input type="number" name="bid_value" class="form-control" id="bid_value" min={{ $auction->min_opening_bid }} aria-describedby="emailHelp">
                                      @else
                                      <input type="number" name="bid_value" class="form-control" id="bid_value" min={{ $bids->first()->bid_value + $auction->min_raise }} aria-describedby="emailHelp">    
                                      @endif
                                    </div>
                                    <div class="col-4">
                                      <button type="submit" class="btn btn-primary submit_bid">Bid</button>
                                    </div>
                                  </div>
                                </form>
                              @elseif ($auction->status == 'Active')
                                <a href="/login" class="btn btn-primary">Login to Bid on this Auction</a> 
                              @endif
                              <div class="alert alert-info alert-dismissible fade show" style="margin-top: 1.5em;">
                                  <strong>Closing Date</strong> {{ $auction->close_date }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-10">
                    @include('partials.bids', ['bids' => $bids])
        </div>        
    </div>


