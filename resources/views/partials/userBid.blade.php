

<div class="row justify-content-left">
<div class="card sm" style="width: auto; margin-right: 1rem;">
  <div class="card-body">
    <div class= "justify-content-center">
    <h2 class="card-text">{{ $bid['name'] }}</a></h2>
    <h4 class="card-text">{{ $bid['bid_value'] }}€ by {{ $bid['bidder'] ?? ''}}</a></h4>
    <h4 class="card-text">{{ $bid['bid_date'] }}</a></h4>
    </div>
    <a href="/auctions/{{ $bid['auction_id'] }}" class="btn btn-primary">Go to auction</a>

  </div>
</div>
</div>