@extends('layouts.app')

@section('title', 'My Bidding History')

@section('content')

@include('partials.bids', ['bids' => $bids])

@endsection
