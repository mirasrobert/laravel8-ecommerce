<!-- Pre Header -->
<div id="pre-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
        <span>
          <i class="fa fa-envelope" aria-hidden="true"></i>
          mrmirasrobert@gmail.com
        </span>
                <span class="ml-3">
          <i class="fa fa-phone" aria-hidden="true"></i>
          010-020-0340
        </span>
            </div>
            <div class="col-md-6">
        <span>
          <a class="ml-2" href="https://github.com/mirasrobert">
            <i class="fa fa-github text-white" aria-hidden="true"></i>
          </a>
          <a class="ml-2" href="https://www.facebook.com/MirasRobert">
            <i class="fa fa-facebook text-white" aria-hidden="true"></i>
          </a>
          <a class="ml-2" href="https://www.instagram.com/robertmiras/">
            <i class="fa fa-instagram text-white" aria-hidden="true"></i>
          </a>
          <a class="ml-2" href="https://www.linkedin.com/in/robert-miras/">
            <i class="fa fa-linkedin-square text-white" aria-hidden="true"></i>
          </a>
        </span>
            </div>
        </div>
    </div>
</div>

{{-- Navigation --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="main-color fw-600 text-size-2rem">FAB</span><span class="text-size-2rem">RIQUE</span>
            <div class="line-dec"></div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::url() == url('/') ? 'active' : '' }}" href="{{ route('home') }}"
                    >Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::url() == url('/products') ? 'active' : '' }}"
                       href="{{ route('product.view') }}">Products</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::url() == url('/cart') ? 'active' : '' }}"
                       href="{{ route('product.cart') }}">
                        <i class="fa fa-shopping-cart"></i>
                        @auth
                            @if(MyCart::instance('default')->count() > 0)
                                {{-- Cart <span class="dot text-center text-dark align-middle fw-bold"> {{ auth()->user()->products->count() }} </span>  --}}
                                Cart <span
                                    class="badge badge-pill badge-danger notify round"> {{ MyCart::instance('default')->count() }} </span>
                            @else
                                Cart
                            @endif

                        @else
                            @if(MyCart::instance('default')->count() > 0)
                                {{-- Cart <span class="dot text-center text-dark align-middle fw-bold"> {{ auth()->user()->products->count() }} </span>  --}}
                                Cart <span
                                    class="badge badge-pill badge-danger notify round"> {{ MyCart::instance('default')->count() }} </span>
                            @else
                                Cart
                            @endif
                        @endauth
                    </a>
                </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-user"></i>
                                Sign In
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('orders.index') }}">My Orders</a>

                            {{-- CHECK IF ADMIN --}}
                            @can('view', auth()->user())
                                <a class="dropdown-item" href="{{ route('shop') }}">Shop</a>
                                <a class="dropdown-item" href="{{ route('product.index') }}">Product</a>
                            @endcan

                            {{-- LOGOUT --}}
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
</nav>
