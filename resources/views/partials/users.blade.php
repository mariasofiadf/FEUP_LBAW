<div class="container-fluid " style="margin: 1rem; width: max">
@foreach($users->chunk(5) as $chunk)
    <div class="row">
    @each('partials.user', $chunk, 'user')
    </div>
@endforeach
</div>