@extends('layouts.app')

@section('title', 'About')

@section('content')

@include('partials.auctionComplaints', ['auction' => $auction, 'auctionReports' => $auctionReports])

@endsection