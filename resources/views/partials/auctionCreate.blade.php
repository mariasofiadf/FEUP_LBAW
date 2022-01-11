<article class="auction">    

@if (is_null($auction))
  <form method="POST" action="{{ route('api/auctions') }}">
@else
  <form method="POST" action="{{ route('auctions/{id}/edit', ['id' => $auction->auction_id]) }}">
@endif
{{ csrf_field() }}
{{ method_field('PUT') }}
<div class="mb-3">
<label for="title" class="form-label">Title</label>
<input type="text" name="title" class="form-control" id="title" value="{{ $auction->title ?? old('title') }}" required autofocus>
</div>
<div class="mb-3" style>
<label for="description" class="form-label">Description</label>
<textarea type="text" name="description" class="form-control" id="description" value="{{ $auction->description ?? old('description') }}" required autofocus>{{ $auction->description ?? '' }}</textarea>
</div>
<div class="mb-3">
<label for="min_opening_bid" class="form-label" >Minimum Opening Bid</label>
<input type="text" name= "min_opening_bid" class="form-control" id="min_opening_bid" value="{{ $auction->min_opening_bid ?? old('min_opening_bid') }}" required autofocus>
<div class="mb-3">
<label for="min_raise" class="form-label">Minimum Raise</label>
<input type="text" name="min_raise" class="form-control" id="min_raise" value="{{ $auction->min_raise ?? old('min_raise') }}" required>
</div>
<label for="min_raise" class="form-label">Start Date</label>
<input type="datetime" name="min_raise" class="form-control" id="min_raise" value="{{ $auction->min_raise ?? old('min_raise') }}" required>
</div>

<label for="min_raise" class="form-label">Close Date</label>
<input type="datetime" name="min_raise" class="form-control" id="min_raise" value="{{ $auction->min_raise ?? old('min_raise') }}" required>
</div>



<label for="auction_category" class="form-label">Category</label>
<select class="form-select" id="auction_categories" aria-label="Default select example" value="{{ $auction->auction_category ?? old('auction_category') }}" name="auction_category" required>
  <option value="ArtPiece">ArtPiece</option>
  <option value="Book">Book</option>
  <option value="Jewelry">Jewelry</option>
  <option value="Decor">Decor</option>
  <option value="Other">Other</option>
</select>

<label for="auction_status" class="form-label">Status</label>
<select class="form-select" id="auction_statuss" aria-label="Default select example" value="{{ $auction->auction_status ?? old('auction_status') }}" name="auction_status" required>
  <option value="Active">Active</option>
  <option value="Hidden">Hidden</option>
  <option value="Canceled">Canceled</option>
  <option value="Closed">Closed</option>
</select>

<div class="mb-3" style="margin-top:1rem;">
<button type="submit" class="btn btn-primary form-control" >Submit</button>
</div>
</form>
  </article>

