@extends('layouts.app')

@section("content")

    @if (true))
        {{-- display auctions --}}
        @foreach($auctions->chunk(5) as $chunk)
            <div class="row">
            @each('partials.auctionPreview', $chunk, 'auction')
            </div>
        @endforeach
    @else
        <div>No auction Found</div>
    @endif

@endsection