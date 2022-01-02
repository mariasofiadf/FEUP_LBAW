

<div class="card sm" style="width: auto; margin-right: 1rem;">
  <div class="card-body">
    <div class= "justify-content-center">
    <h4 class="card-text">{{ $bid->bid_value }}€</a></h5>
    <h4 class="card-text">{{ $bid->bid_date }}</a></h5>
    </div>
    <a href="/auctions/{{ $bid->auction_id }}" class="btn btn-primary">Go to auction</a>

  </div>
</div>