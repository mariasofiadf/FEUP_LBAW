@extends('layouts.app')

@section('title', 'My Bidding History')

@section('content')


<h2> My Bidding History</h2>
<div class="container " style="margin: 1rem;">
    @each('partials.userBid', $bids, 'bid')
</div>

@endsection
