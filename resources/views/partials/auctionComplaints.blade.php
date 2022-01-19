<p class="display-3 text-center"> Complaints made </p>

<div class = "text-md-start lh-base fs-5">
    <dl class = "row">
        @foreach($report in $auctionReports)
            <dt class = "col-sm-6 text-truncate">{{$report->user_id}} said:</dt>
            <dd class = "col-sm-9">
                <p>{{$report->description}}</p>
            </dd>
    </dl>
</div>