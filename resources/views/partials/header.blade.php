<header class = "navbar-container">
    {{-- Main Navigation Bar --}} 
  <nav class="navbar">
    <!-- LOGO -->
    <a class="navbar-logo"  href="{{ url('/auctions') }}">Hand Of Midas</a>

    <!-- NAVIGATION MENU -->
    <div class="nav-links">
        <ul class = "menu">
            <li><a href="/">Home</a></li>
            <li><a href="/">How it Works</a></li>
            <li><a href="/">Auctions</a></li>
            
            <li><a href="/">Users</a></li>
            <li><a href="/">About Us</a></li>
            <li><a href="/">Contact</a></li>
        </ul>


    </div>
    

    <!--<div class="nav-icons">
      <ul class="menu">
        <li><a href="/">ShopCart</a></li>
        <li><a href="/">Notifs</a></li>
      </ul>
    </div>-->

    @if (Auth::check())
      <span>{{ Auth::user()->name }}</span>
      <a class="logout-button" href="{{ url('/logout') }}"> Logout </a> 
    @endif
    
  </nav>
</header>   
