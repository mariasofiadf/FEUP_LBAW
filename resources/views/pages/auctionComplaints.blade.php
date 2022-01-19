@extends('layouts.app')

@section('title', 'Complaints')

@section('content')

@include('partials.auctionComplaints', ['auctionReports' => $auctionReports ?? ''])

@endsection