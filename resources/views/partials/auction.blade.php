<article class="auction" data-id="{{ $auction->id }}">
<header>
  <h2><a href="/auctions/{{ $auctions->id }}">{{ $auction->name }}</a></h2>
  <a href="#" class="delete">&#10761;</a>
</header>

<form class="new_item">
  <input type="text" name="description" placeholder="new item">
</form>
</article>
