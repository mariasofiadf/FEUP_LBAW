

<div class="container border p-1 mb-2 w-75">
  <div class="row text-center align-middle">
    <div class="col-sm align-self-center">
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
    </div> 
    <div class="col-sm align-self-center">
      <span class="text-uppercase text-muted brand">{{ $notif->notif_time }}</span>
    </div>
  </div>
</div>