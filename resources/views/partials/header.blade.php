
<header >
  <div >
    <div class="row">
      <div class="col-3">
        <ul class="nav ">
          <li class="nav-item">
            <a  class="nav-link" href="{{ url('/auctions') }}">Hand Of Midas</a>
          </li>
          @if (Auth::check())
          <li class="nav-item">
            <a  class="nav-link" href="{{ url('/notifications') }}">Notifications: {{Auth::user()->auctionNotifs()->count() ?? '0'}}</a>
          </li>
          @endif

      </div>
      <div class="col-6">
        <ul class="nav justify-content-center">
          <!-- NAVIGATION MENU -->
          <li class="nav-item">
            <a class="nav-link" href="/faq">How it Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/auctions">Auctions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/users">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About Us</a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="/contacts">Contact</a>
          </li>
        </ul>
      </div>
      <div class="col-3">
        <ul class="nav nav-pills  justify-content-end">
        @if (Auth::check())
        <li class="nav-item">
          <a class = "nav-link" href="/users/{{ Auth::user()->user_id }}">{{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" class="btn btn-primary" href="{{ url('/logout') }}"> Logout </a> 
        </li>
        @else
        <li class="nav-item">
          <a class="btn btn-primary" style="margin-right: 1rem;" href="{{ url('/login') }}"> Login </a> 
        </li>
        <li class="nav-item">
          <a  class="btn btn-secondary" href="{{ url('/register') }}"> Register </a> 
        </li>
        @endif
      </ul>
      </div>
    </div>




  <div>
  </header>   
