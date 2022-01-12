<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
  </ol>
</nav>
<div class="container-fluid " style="margin: 1rem; width: max">
@foreach($users->chunk(5) as $chunk)
    <div class="row">
    @each('partials.user', $chunk, 'user')
    </div>
@endforeach
</div>

