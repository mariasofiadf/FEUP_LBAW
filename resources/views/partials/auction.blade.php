<article class="auction" data-id="{{ $auction->id }}">
<header>
  <h2><a href="/auctions/{{ $auction->auction_id }}">{{ $auction->title }}</a></h2>

  <h3>{{ $auction->status }}</h3>
  <h3>{{ $auction->category }}</h3>

  <a href="/auctions/{{ $auction->auction_id }}/delete" class="delete">&#10761;</a>
</header>

</article>

