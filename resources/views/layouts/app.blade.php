<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Scripts of larravel -->
    @vite(['resources/sass/app.scss', ''])


    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">






</head>

<body>

    <!-- start of navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img class="logo"  src=" {{ asset('imgs/logo.jpeg') }}" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link p-lg-3" href="{{ route('matches') }}">Matches</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-lg-3" href="{{ route('news') }}">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-lg-3" href="{{ route('highlights') }}">Highlights</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-lg-3" href="{{ route('contactUs') }}">Contact</a>
                    </li>



                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <ul class="nav-item pb-1 pt-2 ">
                        <a class="btn btn-primary rounded-pill main-btn " href="{{ route('login') }}">{{ __('Login')
                            }}</a>
                    </ul>
                    @endif

                    @else
                    {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link p-lg-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li> --}}

                        {{--
                    </div> --}}

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle p-lg-3" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name}}
                        </a>

                        <ul class="dropdown-menu">
                            {{-- <li><a class="dropdown-item " href="{{ route('user.update',['user_id'=>Auth::id()]) }}">Account</a></li> --}}
                            <li>
                                <form  action="{{ route('user.profile') }}">

                                    <button class="dropdown-item " type="submit"><i class="fa-regular fa-user"></i> Account </button>
                                </form>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="nav-item">
                                <a class="dropdown-item hov-red" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
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
    </nav>








    <main>
        @yield('content')
    </main>


 <!-- start of footer -->
 <div class="footer pt-5 pb-5 text-white-50 text-center text-md-start">
    <div class="container">
        <div class="row gy-2">
            <div class="col-md-12 col-lg-3">
                <div class="info mb-3">
                    <div class="position-relative">
                        <img src=" {{ asset('imgs/footer_logo.png') }}" alt="logo" class="mb-2">
                        <span class="position-absolute pt-3 fs-3 text-white "> &reg;</span>
                    </div>

                    <p class="mb-4 text-white">
                        Fanzone is an online football match ticket booking site. Become a fan now and stand with
                        your team.
                    </p>
                    <h3 class="text-center mb-3">Follow Us</h3>
                    <div class="footerIcons d-flex justify-content-around">
                        <a href=""><i class="fa-brands fa-x-twitter text-white fs-4"></i></a>
                        <a href=""><i class="fa-brands fa-facebook text-white fs-4"></i></a>
                        <a href=""><i class="fa-brands fa-instagram text-white fs-4"></i></a>
                        <a href=""> <i class="fa-brands fa-linkedin text-white fs-4"></i></a>
                    </div>

                </div>

            </div>
            <div class="col-md-12 col-lg-6">
                <h5 class="text-white fw-bold">Who we are</h5>
                <p>We provide many championships you and your family can attend in Egypt and around the world just
                    by using an e-ticket, and we also offer a transportation booking system for every match with
                    high-quality buses.</p>
                <h5 class="text-white fw-bold">Quick Links</h5>
                <div class="footerLinks">
                    <ul class="p-0">
                        <li><i class="fa-solid fa-chevron-right"></i> <a class="text-decoration-none text-white"
                            href="{{ route('home') }}">Home</a> </li>
                        <li><i class="fa-solid fa-chevron-right"></i> <a class="text-decoration-none text-white"
                            href="{{ route('matches') }}">Matches</a></li>

                        <li><i class="fa-solid fa-chevron-right"></i> <a class="text-decoration-none text-white"
                            href="{{ route('news') }}">News</a></li>
                    </ul>
                    <ul class="p-0">
                        <li><i class="fa-solid fa-chevron-right"></i> <a class="text-decoration-none text-white"
                            href="{{ route('contactUs') }}">Contact</a></li>

                        <li><i class="fa-solid fa-chevron-right"></i> <a class="text-decoration-none text-white"
                                href="{{ route('highlights') }}">Highlights</a></li>

                            @guest
                            <li><i class="fa-solid fa-chevron-right"></i> <a class="text-decoration-none text-white"
                                    href="{{ route('login') }}">Login</a></li>
                            <li><i class="fa-solid fa-chevron-right"></i> <a class="text-decoration-none text-white"
                                    href="{{ route('register') }}">SignUp</a></li>
                            @endguest
                    </ul>
                </div>


            </div>

            <div class="col-md-12 col-lg-3">
                <div class="contact">
                    <h5 class="text-light mb-3">Get in Touch</h5>
                    <div class="get-inTouch-icons">
                        <ul class="list-unstyled">
                            <li class="mb-2 text-white"><i class="fa-solid fa-location-dot align-middle"></i>
                                Shoubra Misr,
                                Cairo, Egy,
                                St 5485
                            </li>
                            <li class="mb-2 text-white"><i class="fa-solid fa-phone align-middle"></i> +201228987781
                            </li>
                            <li class="mb-2"><i class="fa-solid fa-envelope align-middle"></i> <a
                                    href="mailto:mostafasawan966@gmai.com">Fanzone@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<footer id="footer" class="d-flex align-items-center justify-content-center text-center">
    <div class="copyright text-white-50">
        Created By <span>Modern Academy Students</span>
        &copy; 2024 - <span>FanZone</span>
    </div>

</footer>
<!-- end of footer -->






    <!-- script files -->


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js')

    <!-- script files -->






</body>

</html>
