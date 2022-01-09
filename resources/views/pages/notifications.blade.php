@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<h2> My Notifications</h2>
<div class="container-fluid " style="margin: 1rem; width: max">
@foreach($notifs->chunk(5) as $chunk)
    <div class="row">
    @each('partials.notification', $chunk, 'notif')
    </div>
@endforeach
</div>


@endsection
