@extends('layouts.app')

@section('title', 'My Bidding History')

@section('content')


<h2> My Bidding History</h2>
@include('partials.bids', ['bids' => $bids])

@endsection
