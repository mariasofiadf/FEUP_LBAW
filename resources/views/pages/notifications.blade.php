@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<h2> My Notifications</h2>
<div class="container-fluid " style="margin: 1rem; width: max">
    @each('partials.notification', $notifs, 'notif')
</div>


@endsection
