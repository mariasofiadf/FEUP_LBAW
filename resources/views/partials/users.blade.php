
<div class="row d-flex align-items-center" style="margin-left: 4rem">
    @foreach($users->chunk(3) as $chunk)
        @each('partials.user', $chunk, 'user')
    @endforeach
</div>  

