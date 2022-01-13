<head>
  <style>
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
    </style>
</head>
<article class="auction">    


@if (is_null($auction))
  <form method="POST" action="{{ route('api/auctions') }}" enctype="multipart/form-data">
@else
  <form method="POST" action="{{ route('auctions/{id}/edit', ['id' => $auction->auction_id]) }}" enctype="multipart/form-data">
@endif
{{ csrf_field() }}
{{ method_field('PUT') }}

@include('partials.errorsuccess')
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
<label for="start" class="form-label">Start Date</label>
<input type="datetime-local" name="start" class="form-control" id="start" value="{{ $auction->start_date ?? '2021-01-12T19:30' }}" required>
</div>

<label for="close" class="form-label">Close Date</label>
<input type="datetime-local" name="close" class="form-control" id="close" value="{{ $auction->close_date ?? '2021-01-12T19:30' }}" required>
</div>



<div class="container mt-5">
        <!-- <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data"> -->
          <h3 class="text-center mb-5">Upload File</h3>
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>

            <!-- <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button> -->
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
<button type="submit"  name="submit" class="btn btn-primary form-control" >Submit</button>
</div>
</form>
  </article>

