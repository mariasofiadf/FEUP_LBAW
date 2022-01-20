<p class="display-3 text-center"> Complaints made </p>

<div class = "text-md-start lh-base fs-5">
    <dl class = "row">
        @foreach($auctionReports as $report)
            <dt class = "col-sm-6 text-truncate">{{$report->user_id}} in the auction {{$report->auction_id}}said:</dt>
            <dd class = "col-sm-9">
                <p>{{$report->description}}</p>
            </dd>
        @endforeach
    </dl>
</div>