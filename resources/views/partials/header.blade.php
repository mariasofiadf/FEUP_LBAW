
<header >
  <div class "container">
    <div class="row">
      <div class="col-3">
        <a  class="nav-link" href="{{ url('/auctions') }}">Hand Of Midas</a>
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
            <a class="nav-link" href="/contact_us">Contact</a>
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
          <a class="nav-link active" class="rounded" href="{{ url('/logout') }}"> Logout </a> 
        </li>
        @endif
      </ul>
      </div>
    </div>




  <div>
  </header>   
