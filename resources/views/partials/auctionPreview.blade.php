

<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a></h5>
    <p class="card-text">Category: {{ $auction->category }}</p>
    <a href="/auctions/{{ $auction->auction_id }}" class="btn btn-primary">Go to auction</a>
  </div>
</div>