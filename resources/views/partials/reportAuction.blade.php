<p class="display-3 text-center pt-5"> Report form </p>

<div class ="container ">
    <div class="card sm align-middle" style="width: auto; margin-right: 1rem;">
    <div class="card-body">
        <form method="POST" action="{{ route('auctions/{id}/report', ['id' => $auction->auction_id]) }}">

            {{ csrf_field() }}
            <div class="mb-3" style>
                <label for="complaint" class="form-label">Reason for complaint</label>
                <textarea type="text" name="complaint" class="form-control" id="complaint"></textarea>
            </div>
            <div class="mb-3" style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary form-control" >Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
