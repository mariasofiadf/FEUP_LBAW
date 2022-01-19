

<div class="col md d-inline-flex" style="width: 14rem; margin: 0.5rem;">
<img class="img-responsive" style="width: 200px; height: 195px;object-fit: cover;" alt="{{$auction->auction_image}}" src="/storage/uploads/{{ $auction->auction_image }}">
  <div class="card-body">
    <h4 class="card-title"><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a></h5>
    <p class="card-text">Category: {{ $auction->category }} </p>
    <p class="card-text">Status: {{ $auction->status }} </p>
    <a href="/auctions/{{ $auction->auction_id }}" class="btn btn-primary">Go to auction</a>

    @if (Auth::check() && Auth::id() == $auction->seller_id )
      <div>
        <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-secondary">Delete</a>
        <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn btn-secondary">Edit</a>
      </div>
    @endif
  </div>
</div>
