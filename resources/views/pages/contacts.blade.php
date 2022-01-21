@extends('layouts.app')

@section('title', 'Contacts')

@section('content')


<title>Contacts</title>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Contact</li>
  </ol>
</nav>
    </div>
  </nav>



@include('partials.contacts')

@endsection