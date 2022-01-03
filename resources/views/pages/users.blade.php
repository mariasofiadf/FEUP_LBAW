@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('partials.searchUsers')

@include('partials.users', ['users' => $users])

@endsection
