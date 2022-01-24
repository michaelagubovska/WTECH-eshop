<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/cat.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/product_signing.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('plugins/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/owlcarousel/assets/owl.theme.default.min.css')}}">
    <link rel="icon" href="{{asset('images/favicon.png')}}">
</head>

<body>

    <header class="header shop" role="banner">
        <!-- Topbar from blade-->
        <div class="topbar">
            <div class="container-fluid info_topbar d-none d-sm-block">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="top_banner_item">
                            Doprava zdarma pri nákupe nad 40eur
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="top_banner_item ">
                            Vrátenie do 30 dní zdarma
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="top_banner_item ">
                            Vyrobené na Slovensku
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                @guest
                    <div class="row">
                        <div class="col d-flex justify-content-md-end justify-content-center">
                            <div class="btn-toolbar">
                                <form action="login" method="get">
                                    <button class="btn btn-outline-light button_style btn-sm text-nowrap mt-2 mb-2 mr-2 ">
                                        Prihlásiť sa
                                    </button>
                                </form>
                                <form action="register" method="get">
                                    <button class="btn btn-outline-light button_style btn-sm text-nowrap m-2">Registrovať
                                        sa
                                    </button>
                                </form>
                                <button class="btn btn-outline-light button_style btn-sm text-nowrap mt-2 mb-2 ml-2">
                                    Kontakt
                                </button>
                            </div>
                        </div>
                    </div>
                @endguest
                @auth
                    <div class="row">
                        <div class="col d-flex justify-content-md-end justify-content-center">
                            <div class="">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button href="route('logout')" class="btn btn-outline-light button_style btn-sm text-nowrap m-2"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                        Odhlásiť sa
                                    </button>

                                </form>

                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                 class="bi bi-person-circle m-2" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd"
                                      d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        <!-- End Topbar -->
    </header>

    <!--Navigation bar-->
    <nav id="navbar" class="sticky-top">
        <div class="container bg-white">
            <div class="row">
                <div class="d-flex align-items-center col-md-2 col-4 order-md-0 order-1 mb-2 mb-md-0 mt-3">
                    <div class="container-fluid align-items-center">
                        <a href="/" class="navbar-brand mb-0 h1">
                            <img class="logo-image d-inline-block align-top" src="{{asset('images/logo.png')}}" alt="logoMerch">
                        </a>
                    </div>
                </div>
                <div class="col-md-5 col-4 order-md-1 order-0 mb-2 mb-md-0 mt-3">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <div class="container-fluid">
                            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                    class="navbar-toggler"
                                    aria-controls="navbarNav" aria-expanded="false" aria-label="Zobraz menu">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown ">
                                        <a href="#" class="nav-link dropdown-toggle nav_bar_item" id="navbarDropdownMuzi"
                                           role="button"
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            Muži
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMuzi">
                                            <li><a href="1" class="dropdown-item">Mužské mikiny</a></li>
                                            <li><a href="2" class="dropdown-item">Mužské tričká</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle nav_bar_item" id="navbarDropdownZeny"
                                           role="button"
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            Ženy
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownZeny">
                                            <li><a href="3" class="dropdown-item">Ženské mikiny</a></li>
                                            <li><a href="4" class="dropdown-item">Ženské tričká</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle nav_bar_item" id="navbarDropdownDoplnky"
                                           role="button"
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            Doplnky
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownDoplnky">
                                            <li><a href="5" class="dropdown-item">Fľaše</a></li>
                                            <li><a href="6" class="dropdown-item">Čiapky</a></li>
                                            <li><a href="7" class="dropdown-item">Ruksaky</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </nav>
                </div>

                <nav class="col-md-4 col-12 mt-md-4 mb-3 order-md-2 order-3">
                    <form class="d-flex justify-content-end" action="search" method="get">
                        <div class="col-s-4">
                            <input type="text" name="search_bar" class="form-control search_bar" placeholder="Vyhľadaj...">
                        </div>
                        <button type="submit" class="btn btn-outline-light button_style ms-2">Vyhľadávanie</button>
                    </form>
                </nav>

                <div class="col-md-1 col-4 mt-4 order-md-3 order-2 mb-2 mb-md-0">
                    <div class="d-flex justify-content-center">
                        <a href="cart" class="cart-anchor">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                 class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <main class="content">

        @yield('content')

    </main>

    <footer>
        <!-- Information footer from blade -->
        <nav class="container py-3">
            <section class="row footer_links">
                <article class="col-md col-xs-12">
                    <ul>
                        <li>
                            <a href="">Kontakt</a>
                        </li>
                    </ul>
                </article>
                <article class="col-md col-xs-12">
                    <ul>
                        <li>
                            <a href="">Obchodné podmienky</a>
                        </li>
                    </ul>
                </article>
                <article class="col-md col-xs-12">
                    <ul>
                        <li>
                            <a href="">Doprava</a>
                        </li>
                    </ul>
                </article>
                <article class="col-md col-xs-12">
                    <ul>
                        <li>
                            <a href="">Platba</a>
                        </li>
                    </ul>
                </article>
                <article class="col-md col-xs-12">
                    <ul>
                        <li>
                            <a href="">Reklámacia</a>
                        </li>
                    </ul>
                </article>
            </section>
        </nav>
        <!--Copyright footer-->
        <section class="copyright">
            <div class="container-fluid info_topbar">
                <section class="inner">
                    <section class="container">
                        <section class="row">
                            <article class="col">
                                <div class="col d-flex justify-content-start mt-3">
                                    <p>© 2021 Merchsort, s.r.o.</p>
                                </div>
                            </article>
                            <article class="col">
                                <div class="col d-flex justify-content-end mt-1 mb-1">
                                    <img src="{{asset('images/logo_bw.png')}}" alt="logo_Merch_bw" height="50px">
                                </div>
                            </article>
                        </section>
                    </section>
                </section>
            </div>
        </section>

    </footer>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="{{asset('plugins/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/cart.js')}}"></script>
<script src="{{asset('js/product_detail.js')}}"></script>
<script src="{{asset('js/carousel.js')}}"></script>
<script src="{{asset('js/selected_size.js')}}"></script>
<script src="{{asset('js/slider.js')}}"></script>
<script type="text/javascript"> initSlider()</script>
<script type="text/javascript"> selectedValue()</script>
<script type="text/javascript"> productCount()</script>
<script type="text/javascript"> productCartCount()</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>

</body>
</html>
