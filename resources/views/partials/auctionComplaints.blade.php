<p class="display-3 text-center"> Complaints made </p>

<div class = "text-md-start lh-base fs-5">
    <dl class = "row">
    @foreach($auctionReports->chunk(8) as $chunk)
        <dt class = "col-sm-6 text-truncate">{{$chunk->user_id}} said:</dt>
        <dd class = "col-sm-9">
            <p>{{$chunk->description}}</p>
        </dd>
    </dl>

</div>