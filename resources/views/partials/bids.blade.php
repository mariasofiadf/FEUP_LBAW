

<div class="container " style="margin: 1rem;">
@foreach($bids->chunk(5) as $chunk)
    <div class="row justify-content-left">
    @each('partials.bid', $chunk, 'bid')
    </div>
@endforeach
</div>


