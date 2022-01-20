<p class="display-3 text-center"> Complaints made </p>

<div class = "text-md-start lh-base fs-5">
    <dl class = "row">
        @foreach($auctionReports as $report)
            <dt class = "col-sm-6 text-truncate">{{User::where('user_id', $report->user_id)->username}} said:</dt>
            <dd class = "col-sm-9">
                <p>{{$report->description}}</p>
            </dd>
        @endforeach
    </dl>
</div>