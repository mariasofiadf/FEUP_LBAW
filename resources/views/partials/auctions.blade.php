
-<div class="container-fluid " style="margin: 1rem; width: max">
@foreach($auctions->chunk(5) as $chunk)
    <div class="row">
    @each('partials.auctionPreview', $chunk, 'auction')
    </div>
@endforeach

<a href="/create" class="btn btn-primary">Create Auction</a>
</div>

<form class="auction-form">
    <div class="row">
        <div class="col-lg-12">
            <input type="number" placeholder="Auction Name" name="query" id="query" value="{{ request()->input('query') }}">
        </div>
        <a href="search/{{query}}" class="btn btn-primary">Search</a>
    </div>
</form> 

<form method="POST" action="{{ route('login') }}">

    {{ csrf_field() }}
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
  </div>
  <div class="password">
    <label for="password" class="form-label">Password</label>
    <input type="password" name= "password" class="form-control" id="password">

  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
  <a class="btn btn-secondary" href="{{ route('register') }}"> Register </a>
</form>