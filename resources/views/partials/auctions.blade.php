
-<div class="container-fluid " style="margin: 1rem; width: max">
@foreach($auctions->chunk(5) as $chunk)
    <div class="row">
    @each('partials.auctionPreview', $chunk, 'auction')
    </div>
@endforeach

<a href="/create" class="btn btn-primary">Create Auction</a>
</div>