


<form method="GET" action="{{ route('search') }}">
{{ csrf_field() }}
    <div class="row justify-content-center">
        <div class="align-items-center input-group m-4 w-50 mb-3 col-1">
            <label for="query" class="form-label" ></label>
            <input type="text" name="query" class="form-control rounded"  placeholder="Keyword"  id="query"aria-label="Search"
            aria-describedby="search-addon">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
    
</form>

