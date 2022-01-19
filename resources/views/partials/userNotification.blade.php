

<div class="row">
<div class="col md card" style="width: 14rem; margin: 0.5rem;">
  <div class="card-body">

    @if(!is_null($notif->auction()->first()))

      <h3 class="card-title">{{ $notif->notif_category }} by 
        <a href="/users/{{ $notif->userNotifier()->first()->user_id }}">{{ $notif->userNotifier()->first()->name }}</a>
        on <a href="/auctions/{{ $notif->auction_id }}">{{ $notif->auction()->first()->title }}</a>
      </h5>
    @else
      <h3 class="card-title">{{ $notif->notif_category }} by 
        <a href="/users/{{ $notif->userNotifier()->first()->user_id }}">{{ $notif->userNotifier()->first()->name }}</a>
      </h5>
    @endif
    <p class="card-title">{{ $notif->notif_time }}</p>
  </div>
</div>
</div>