


<div class="container mb-5">
  <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">                    
                      <img class="main-image p-3" style="width: 100%; height:100%; object-fit: cover;" alt="" src="/storage/uploads/{{ $auction->auction_image }}">
                      
                    </div>
                    <div class="col-md-6 ">
                       <div class="pull-right text-end p-3">
                        
                        @if (Auth::check() && !(Auth::id() == $auction->seller_id)  && !Auth::user()->auctionFollows()->where('id_followed',$auction->auction_id)->where('id_follower', Auth::user()->user_id)->first())
                            <div class="align-items-center follow"> 
                            <a href="/reportAuction/{{ $auction->auction_id }}" class = "btn btn-outline-danger">Report</a>
                              <a class="btn  btn-outline-primary follow" id="follow">Follow</a>
                            </div>
                        @elseif (Auth::check() && !(Auth::id() == $auction->seller_id) ) 

                            <div class="align-items-center"> 
                              <a href="/reportAuction/{{ $auction->auction_id }}" class = "btn btn-outline-danger">Report</a>
                              <a class="btn  btn-outline-primary unfollow" id="follow">Unfollow</a>
                            </div>
                        @else
                                <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-outline-danger">Delete</a>
                                <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn  btn-outline-primary ">Edit</a>
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
                              @endif
                              @if ( (Auth::check() && Auth::id() == $auction->seller_id ) or (Auth::check() && Auth::user()->is_admin))
                                
                              @elseif (Auth::check() && $auction->status == 'Active' && $bids->first()->bidder()->first()->user_id != Auth::id())
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
                              @elseif ($auction->status == 'Active' && !Auth::check())
                                <a href="/login" class="btn btn-primary">Login to Bid on this Auction</a> 
                              @endif
                              @if(!is_null($bids->first()))
                              <p class = " mt-5 text-center"> <a href="#scrollspyHeading1" class = "">See Bids</a></p>
                              @endif
                              

                              @if ($auction->status == 'Active')
                                <div class="alert alert-info alert-dismissible fade show" style="margin-top: 1.5em;">
                                  <strong>Closing Date</strong> {{ $auction->close_date }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>
                              @elseif (is_null($bids->first()))
                              <div class="alert alert-info card-text" role="alert"> <strong>Closed</strong> This auction ended with no bids</div>
                              @else
                              <div class="alert alert-info card-text" role="alert"> <strong>This auction ended</strong> The winning bid was  {{ $bids->first()->bid_value ?? 0}}€ by {{$winner->name ?? 'null'}}</div>
                              @endif
                              <p></p>
                              
                            </div>
                    </div>
                </div>
            </div>

        </div>
        <p></p><p></p>
        @if(!is_null($bids->first()))
          <div class = "mt-4"data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example " tabindex="0">
            <h4 id="scrollspyHeading1">
            <div class="row d-flex justify-content-center pt-4 ">
            <h2 class="card-title text-center text-uppercase">All Bids</h2>   
              <div class="col-md-10">
                @include('partials.bids', ['bids' => $bids])
              </div>
            </div>
            </h4> 
          </div>
        @endif
  </div>


  </div>        
</div>


