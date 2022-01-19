

<div class="row justify-content-left">
  <div class="card sm" style="width: auto; margin-right: 1rem;">
    <div class="card-body">
      <div class= "justify-content-center">
      <h4 class="card-text">{{ $bid->bid_value }}€ by {{ $bid->bidder()->first()->name ?? ''}}</a></h4>
      <p class="card-text">{{ $bid->bid_date }}</a></p>
      </div>
    </div>
  </div>
</div>