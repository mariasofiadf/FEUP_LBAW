@extends('layouts.app')

@section('title', 'About')

@section('content')

@include('partials.auctionComplaints', ['auctionReports' => $auctionReports])

@endsection