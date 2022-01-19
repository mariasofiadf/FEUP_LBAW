
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">

  <!-- <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h4 class="card-title"><a href="/users/{{ $user->user_id }}">{{ $user->name }}</a></h5>

  </div> -->
              <!-- Profile picture card-->
              
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
  <div class="card-body2">
      <div class="account-info">
        <div class="user-profile">
          <div class="user-avatar">
            <picture>
              <source id="s1" srcset="{{ $user->profile_image }}" type="image/webp">
              <source id="s2" srcset="https://bootdey.com/img/Content/avatar/avatar7.png" type="image/png">
              <img src="{{ $user->profile_image }}" alt="" onerror="this.onerror=null;document.getElementById('s1').srcset=document.getElementById('s2').srcset=this.src;">
          </picture>
          </div>
          <h5 class="user-name"><a href="/users/{{ $user->user_id }}">{{ $user->name }}</a></h5>
          <h6 class="user-email">@ {{ $user->username }}</h6>
        </div>
        <div class="about">
          <h5>About</h5>
          <p>I think we should had an about section.</p>
        </div>
      </div>
  </div>
  </div>