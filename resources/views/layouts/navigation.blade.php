

<!-- Start Navigation -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="mainNav" >
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">ZALADA</a>
      <!-- Search -->
      <form class="d-flex">
        <input
          class="form-control me-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
        />
        <button class="btn btn-outline-primary text-primary" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <!-- End Search -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('product.cart') }}">
              <i class="fas fa-shopping-cart"></i>
              @auth
              @if(MyCart::instance('default')->count() > 0)
              {{-- Cart <span class="dot text-center text-dark align-middle fw-bold"> {{ auth()->user()->products->count() }} </span>  --}}
              Cart <span class="dot text-center text-dark align-middle fw-bold"> {{ MyCart::instance('default')->count() }} </span>   
              @else
              Cart
              @endif 
              @else
              Cart
              @endauth
            </a>
          </li>
        @guest
          @if (Route::has('login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="fas fa-user"></i>
              Sign In
            </a>
          </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu text-white" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">User</a></li>
              <li><a class="dropdown-item" href="{{ route('product.index') }}">Product</a></li>
              <li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
              </li>
              </li>
            </ul>
          </li>   
        @endguest
        </ul>
      </div>
    </div>
  </nav>

{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
 --}}
