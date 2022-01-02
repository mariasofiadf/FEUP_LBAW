@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('partials.users', ['users' => $users])

@endsection
