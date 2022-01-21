
<div class = "container">
  
  <div class="row">
  <div class="card sm m-1" style="margin-right: 1rem;">
    <div class="card-body">
          <h3 class="text">{{ $bid->bid_value }}€ by {{ $bid->bidder()->first()->name ?? ''}}</h3>
          <span class="text-uppercase text-muted brand">{{ $bid->bid_date }}</span>
    </div>
  </div>
</div>
</div>
