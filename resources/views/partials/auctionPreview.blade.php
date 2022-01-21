

<div class="card flex-md-row mb-4 shadow-sm h-md-250">
  <div class="card-body d-flex flex-column align-items-start">
      <strong class="d-inline-block mb-2 text-primary">{{ $auction->title }}</strong>
      <div class="mb-1 text-muted small">Category: {{ $auction->category }}</div>
      <div class="mb-1 text-muted small">Status: {{ $auction->status }}</div>
      <p></p><p></p><p></p>
      <div class = "col">
      @if (Auth::check() && Auth::id() == $auction->seller_id )        
        <a href="/auctions/{{ $auction->auction_id }}/delete" class="btn btn-outline-primary btn-sm">Delete</a>
        <a href="/auctions/{{ $auction->auction_id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
      @endif
      
        <a class="btn btn-outline-primary btn-sm" role="button" href="/auctions/{{ $auction->auction_id }}">Go to auction</a>
      </div>
  </div>
  <img class="card-img-right flex-auto d-none d-lg-block" style="width: 200px; height: 195px;object-fit: cover;" alt="{{$auction->auction_image}}" src="/storage/uploads/{{ $auction->auction_image }}">
</div>