@extends('layouts.app')

@section('title', "User Edit")

@section('content')
  @include('partials.userEdit',  ['user' => $user])
@endsection
