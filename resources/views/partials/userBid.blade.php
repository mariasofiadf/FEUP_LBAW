


<div class="container border p-1 mb-2 w-75">
  <div class="row text-center align-middle">
    <div class="col-sm align-self-center">
      <h5 class="card-text">{{ $bid->auction()->first()->title }}</a></h5>
    </div>
    <div class="col-sm align-self-center">
    <span class="text-uppercase text-muted brand">{{ $bid->bid_value }}€</span>
    </div>
    <div class="col-sm align-self-center">
    <span class="text-uppercase text-muted brand">{{ $bid->bid_date }}</span>
    </div>
    <div class="col-sm text-end align-self-center">
    <a href="/auctions/{{ $bid->auction_id }}" class="btn btn-outline-primary">Go to auction</a>
    </div>
  </div>
</div>