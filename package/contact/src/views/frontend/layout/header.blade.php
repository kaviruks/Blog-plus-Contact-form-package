<nav class="navbar navbar-expand-lg navbar-dark text-bg-secondary">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('user.home') }}">Home </a>
            </li>

            @can('create post')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.create_post') }}">Create Post</a>
                </li>
            @endcan
        </ul>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
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
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link">{{ Auth::user()->name }}</a>
                    </li>


                    <a class="nav-link " href="{{ route('logout') }}"
                        onclick="event.preventDefault();

                                                document.getElementById('logout-form').submit();">
                        <strong> {{ __('Sign Out') }}</strong>
                        <i class="dropdown-item-icon ti-power-off"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </div>
</nav>
