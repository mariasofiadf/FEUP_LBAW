<p class="display-3 text-center"> Complaints made </p>

<div class = "text-md-start lh-base fs-5">
    <dl class = "row">
        @foreach($auctionReports as $report)
            <dt class = "col-sm-6 text-truncate">The user {{$report->user->username}}, in the auction {{$report->auction->title}}, said:</dt>
            <dd class = "col-sm-9">
                <p>{{$report->description}}</p>
            </dd>
        @endforeach
    </dl>
</div>