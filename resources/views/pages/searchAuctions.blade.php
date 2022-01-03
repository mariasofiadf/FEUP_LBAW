@extends('layouts.app')

@section("content")

    @if (count($auctions))
        {{-- display auctions --}}
        @foreach($auctions as $auction)
            <div class="row">
            @each('partials.auctionPreview', $chunk, 'auction')
            </div>
        @endforeach
    @else
        <div>No auction Found</div>
    @endif

@endsection