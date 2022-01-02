

<div class="card" style="width: 18rem; margin-right: 1rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h4 class="card-title"><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a></h5>
    <p class="card-text">Category: {{ $auction->category }}</p>
    <a href="/auctions/{{ $auction->auction_id }}" class="btn btn-primary">Go to auction</a>

    @if (Auth::check() && Auth::id() == $auction->seller_id )
      <div>
      <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-secondary">Delete</a>
      <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn btn-secondary">Edit</a>
      </div>
    @endif
  </div>
</div>