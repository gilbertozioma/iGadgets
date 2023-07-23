<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    {{-- Start of the brand/logo section --}}
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            {{-- Logo with a link to the admin dashboard --}}
            <a class="navbar-brand brand-logo text-primary text-bold" href="{{ url('admin/dashboard') }}">
                <img src="{{ asset('assets/images/iGadgets admin.png') }}" alt="logo"/>
                {{-- iGadgets --}}
            </a>
            {{-- Button to minimize the navbar on smaller screens --}}
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    {{-- End of the brand/logo section --}}

    {{-- Start of the menu items section --}}
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav ml-auto">

            {{-- Dropdown menu for the user profile --}}
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    {{-- Display the username of the logged-in user --}}
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                </a>
                {{-- Dropdown menu items --}}
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="{{ url('/admin/settings') }}" class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                    </a>
                    {{-- Logout link --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-primary"></i> {{ __('Logout') }}
                    </a>
                    {{-- Logout form --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

            {{-- Button to toggle the offcanvas menu on smaller screens --}}
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </ul>
    </div>
    {{-- End of the menu items section --}}
</nav>
