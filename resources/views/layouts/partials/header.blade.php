<header class="d-block">
    <!-- NAVBAR -->
    <nav id="top_nav"  class="navbar navbar-expand-md navbar-light shadow-sm fixed-top" >
            <div class="container">
                <a class="navbar-brand text-white font-weight-bold" href="{{ url('/') }}">
                    {{ config('app.name', 'DeliveBoo') }}
                </a>
                <button class="navbar-toggler border border-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                   <!--  <span class="navbar-toggler-icon text-white"></span> -->
                   <i class="fas fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link  text-white font-weight-bold" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link  text-white font-weight-bold" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ url('/admin') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Dashboard
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    <div class="jumbo d-flex align-items-center justify-content-center text-center ">
        <div class="container text-center">

            <div class="jumbo_text p-5">
                
                <h1 class="display-3"> <strong>Deliveboo</strong> </h1>
                <h2 class="display-5">Mangia cosa, dove e quando vuoi tu.</h2>
            
            </div>
        
        </div>
    </div>
</header>