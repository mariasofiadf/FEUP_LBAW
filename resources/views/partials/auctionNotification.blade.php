

<div class="row">
<div class="col md card" style="width: 14rem; margin: 0.5rem;">
  <div class="card-body">

    <h2 class="card-title"><a href="/auctions/{{ $notif->auction_id }}">{{ $notif->auction()->first()->title }}</a></h5>
    <h4 class="card-title">{{ $notif->anotif_category }} by {{ $notif->user()->first()->name }}</h5>
    <p class="card-title">{{ $notif->anotif_time }}</p>

  </div>
</div>
</div>