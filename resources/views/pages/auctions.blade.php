@extends('layouts.app')

@section('title', 'Auctions')

@section('content')

@include('partials.auctions', ['auctions' => $auctions])

@endsection
