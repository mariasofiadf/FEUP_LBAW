
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">



<div class="card flex-md-row shadow-sm h-md-250 border mt-5 me-2" style = "width: 30%;">
  <div class="card-body d-flex flex-column align-items-start">
      <strong class="d-inline-block mb-2 text-primary">{{ $user->name }}</strong>
      <div class="mb-1 text-muted small">@ {{ $user->username }}</div>
      <p></p><p></p><p></p>
      <div class = "col">
      
        <a class="btn btn-outline-primary btn-sm" role="button" href="/users/{{ $user->user_id }}">See profile</a>
      </div>
  </div>
  <img class="card-img-right flex-auto d-none d-lg-block" style="width: 200px; height: 195px;object-fit: cover;" alt="" src="/storage/uploads/{{ $user->profile_image }}">
</div>