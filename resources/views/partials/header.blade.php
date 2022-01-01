
<header class = "navbar-container">
    {{-- Main Navigation Bar --}} 
  <nav class="navbar">
    <!-- LOGO -->
    <a class="navbar-logo"  href="{{ url('/auctions') }}">Hand Of Midas</a>

    <!-- NAVIGATION MENU -->
    <div class="nav-links">
        <ul class = "menu">
            <li><a href="/faq">How it Works</a></li>
            <li><a href="/auctions">Auctions</a></li>
            
            <li><a href="/users">Users</a></li>
            <li><a href="/about">About Us</a></li>  
            <li><a href="/contact_us">Contact</a></li>
        </ul> 
    </div>

    @if (Auth::check())
      <a class = "user_name" href="/users/{{ Auth::user()->user_id }}">{{ Auth::user()->name }}</a>
      <a class="logout-button" href="{{ url('/logout') }}"> Logout </a> 
    @endif

  </nav>
  </header>   
