

<div class="row">
<div class="col md card" style="width: 14rem; margin: 0.5rem;">
  <div class="card-body">

    <h2 class="card-title"><a href="/auctions/{{ $notif['auction_id'] }}">{{ $notif['name'] }}</a></h5>
    <h4 class="card-title">{{ $notif['anotif_category'] }}</h5>
    <p class="card-title">{{ $notif['date'] }}</p>
    <a href="/auctions/{{ $notif['auction_id'] }}" class="btn btn-primary">Go to auction</a>

  </div>
</div>
</div>