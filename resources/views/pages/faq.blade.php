@extends('layouts.app')

@section('title', 'FAQ')

@section('content')

<title>FAQ</title>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
  </ol>
</nav>

@include('partials.faq')

@endsection