<div class="py-5">
    <div class="container">
        <div class="row hidden-md-up">
            @foreach($users->chunk(3) as $chunk)
                @each('partials.user', $chunk, 'user')
            @endforeach
        </div>
    </div>
</div>

