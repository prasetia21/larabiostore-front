<!-- Navigasi -->
    <nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="navbar-brand"
          ><img src="images/olshop.png" alt="Logo" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories') }}" class="nav-link">Categories</a>
            </li>
            <!-- <li class="nav-item">
              <a href="/rewards.html" class="nav-link">Rewards</a>
            </li> -->
          </ul>
           
          <!-- Button -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            
            @guest
                <li class="nav-item">
                  <a href="{{ route('login') }}" class="btn btn-success text-white rounded-pill btn-cust mr-2">Sign In</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('register') }}" class="btn rounded-pill btn-reg btn-cust"
                    >Sign Up</a
                  >
                </li>
            @endguest

          </ul>

          @auth
              <!-- Desktop Menu -->
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
              <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                <img src="/images/icon-user.png" alt="" class="rounded-circle mr-2 profile-picture"/>
                Hi, {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu">
                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item"
                  >Settings</a
                >
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                </form>
              </div>
            </li>
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                @php
                  $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                @endphp
                @if ($carts > 0)
                   <img src="/images/icon-cart-filled.svg" alt="" /> 
                   <div class="card-badge">{{ $carts }}</div>
                @else
                  <img src="/images/icon-cart-empty.svg" alt="" />
                @endif
              </a>
            </li>
          </ul>

          <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Hi, {{ Auth::user()->name }}
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                @php
                  $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                @endphp
                @if ($carts > 0)
                   <img src="/images/icon-cart-filled.svg" alt="" /> 
                   <div class="card-badge">{{ $carts }}</div>
                @else
                  <img src="/images/icon-cart-empty.svg" alt="" />
                @endif
              </a>
            </li>
          </ul>
          @endauth

        </div>
      </div>
    </nav>