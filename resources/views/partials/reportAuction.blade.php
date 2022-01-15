<p class="display-3 text-center"> Report form </p>

<div class="card sm align-middle" style="width: auto; margin-right: 1rem;">
    <div class="card-body">
        <form method="POST" action="{{ route('auctions/{id}/report', ['id' => $auction->auction_id]) }}">

            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="mb-3" style>
                <label for="complaint" class="form-label">Description</label>
                <textarea type="text" name="complaint" class="form-control" id="complaint"></textarea>
            </div>
        </form>
    </div>
</div>