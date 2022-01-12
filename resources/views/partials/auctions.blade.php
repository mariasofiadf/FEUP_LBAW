<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Auctions</li>
  </ol>
</nav>

<div class="container-fluid " style="margin: 1rem; width: max">
@foreach($auctions->chunk(5) as $chunk)
    <div class="row">
    @each('partials.auctionPreview', $chunk, 'auction')
    </div>
@endforeach
@if (Auth::check() and !Auth::user()->is_admin)
<a href="/create" class="btn btn-primary">Create Auction</a>

@endif
</div>

