
<div class = "container">
  
  <div class="row">
  <div class="card sm m-1" style="margin-right: 1rem;">
  <div class="card-body">
      <div class= "row">
        <h2 class="card-text">{{ $bid->auction()->first()->title }}</a></h2>
        <span class="text-uppercase text-muted brand">{{ $bid->bid_value }}€</span><p></p>
        <span class="text-uppercase text-muted brand">{{ $bid->bid_date }}</span>
      </div>
      <a href="/auctions/{{ $bid->auction_id }}" class="btn btn-outline-primary">Go to auction</a>

    </div>
  </div>
</div>
</div>
