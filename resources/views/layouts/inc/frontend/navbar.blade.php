<div class="main-navbar shadow sticky-top">
    {{-- Top Navbar --}}
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                {{-- Website Logo --}}
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    @php
                        // Retrieve the website logo path from the 'settings' table
                        $settings = \App\Models\Setting::first();
                        $websiteLogo = $settings ? $settings->logo : null;
                    @endphp
                    @if ($websiteLogo)
                        <a href="{{ url('/') }}"><img src="{{ asset($websiteLogo) }}" class="mb-3" alt="Logo" style="max-height: 30px;"></a>
                    @else
                        <a href="{{ url('/') }}"><img class="w-50" src="{{ asset('assets/images/iGadgets.png') }}" alt="logo"></a>
                    @endif
                </div>

                {{-- Website Logo for mobile view --}}
                <div class="navbar-brand d-block d-sm-block d-md-none d-lg-none">
                    @php
                        // Retrieve the website logo path from the 'settings' table
                        $settings = \App\Models\Setting::first();
                        $websiteLogo = $settings ? $settings->logo : null;
                    @endphp
                    @if ($websiteLogo)
                        <a href="{{ url('/') }}"><img src="{{ asset($websiteLogo) }}" class="p-1" alt="Logo" style="max-height: 40px;"></a>
                    @else
                        <a href="{{ url('/') }}"><img class="w-50" src="{{ asset('assets/images/iGadgets.png') }}" alt="logo"></a>
                    @endif
                </div>
                {{-- Search Bar --}}
                <div class="col-md-5 my-auto">
                    <form action="{{ url('search') }}" method="GET" role="search">
                        <div class="input-group">
                            <input type="search" name="search" value="{{ Request::get('search') }}" placeholder="Search your product" class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                {{-- User Actions --}}
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('cart') }}">
                                <i class="fa fa-shopping-cart"></i> Cart (<livewire:frontend.cart.cart-count />)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('wishlist') }}">
                                <i class="fa fa-heart"></i> Wishlist (<livewire:frontend.wishlist-count />)
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                {{-- Show login link if user is not logged in --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa fa-sign-in"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                {{-- Show register link if user is not logged in --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- Show dropdown menu if user is logged in --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ url('orders') }}"><i class="fa fa-list"></i> My Orders</a></li>
                                    <li><a class="dropdown-item" href="{{ url('wishlist') }}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                    <li><a class="dropdown-item" href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                    <li>
                                        {{-- Logout link --}}
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Navigation Bar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            {{-- Navbar Toggler Button --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="p-2 float-end navbar-toggler-icon">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/collections') }}">All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/new-arrivals') }}">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/featured-products') }}">Featured Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
