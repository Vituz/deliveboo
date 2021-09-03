<?php
    $links = config('dtype.links');
    $categories = config('dtype.categories');
    $contacts = config('dtype.contacts');
    $pay_methods = config('dtype.pay_methods');
    $socials = config('dtype.socials');  
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DeliveBoo') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- F.A -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'DeliveBoo') }}
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
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
        <main class="py-4">
            @yield('content')
        </main>
        
        <footer>
        <div class="container">
            <!-- TOP FOOTER -->
            <div class="top_footer d-flex">
                <div class="col-md-4 p-0">                                      
                    <ul>
                        <li>
                            <h2>Quick links</h2>
                        </li>                       
                        @foreach($links as $link)
                        <li> 
                            
                            <a href="">{{$link['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a> 
                        </li>     
                        @endforeach
                        <li>
                            <a href="{{route('register')}}">Add Restaurant <i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>
                        <li>
                            <a href="{{route('login')}}">My Account<i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>   
                                            
                    </ul>
                </div>
                <div class="col-md-4 p-0">                   
                   <ul>        
                        <li>
                            <h2>Categories</h2>
                        </li>               
                        @foreach($categories as $category)
                        <li> 
                            <a href="{{-- {{ route($item['href'])}} --}}">{{$category['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>     
                        @endforeach                       
                    </ul>
                </div>
                <div class="col-md-4 p-0">
                    <ul>   
                        <li>
                            <h2>Contacts</h2>
                        </li>                    
                        @foreach($contacts as $contact)
                        <li> 
                            <a href="{{-- {{ route($contact['href'])}} --}}">{{$contact['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>     
                        @endforeach                       
                    </ul>
                </div>

            </div>
            <!-- /TOP FOOTER -->

            <!-- BOTTOM FOOTER -->

            <div class="bottom_footer d-flex">
                <div class="col-md-7 pay_methods">
                   <div class="btn btn-light pay_card ">
                       <a href="#">
                           <span >Lingua </span> &nbsp;<i class="fas fa-globe"></i></i>
                       </a>
                    </div>
                    @foreach($pay_methods as $item)
                    <div class="btn p-0 btn-light logo_btn">
                        <a href="#">
                            <img src="{{$item['href']}}" alt="">
                        </a>
                    </div>
                    @endforeach
                    
                </div>
                <div class="col-md-5  socials">
                    <ul class="d-flex">
                        @foreach($socials as $item)
                        <li class="social_card">
                            <div class=" align-items-end">
                                <a href="#">
                                    <img src="{{$item['href']}}" alt="">
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <!--  @foreach($socials as $item)
                    <div class="social_card">
                        <a href="#">
                            <img src="{{$item['href']}}" alt="">
                        </a>
                    </div>
                    @endforeach -->
                </div>
            </div>
        </div>
            <!-- /BOTTOM FOOTER -->
        
        </footer>
    </div>
</body>

</html>