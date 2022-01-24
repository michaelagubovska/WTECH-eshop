<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_p_detail.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_p_list.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="{{asset('images/favicon.png')}}">
</head>

<body>
<header>
    <div class="row" id="admin_header">
        <div class="col-md-3 col-5 mt-4 order-1 order-md-0 ps-md-4">
            <div class="container-fluid">
                <a href="/admin" class="navbar-brand mb-0 h1">
                    <img class="d-inline-block align-top" src="{{asset('images/logo.png')}}" alt="logoMerch"
                         height="50px">
                </a>
            </div>
        </div>
        <nav class="col-md-7 col-3 mt-4 order-0 order-md-1 ps-4 ps-md-0 navbar navbar-expand-md navbar-light">
            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    class="navbar-toggler"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Zobraz menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/admin/product_list" class="nav-link nav_bar_item" id="navbarAdminZoznamProduktov"
                           role="button">
                            Zoznam produktov
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/new_product" class="nav-link nav_bar_item" id="navbarAdminPridatProdukt"
                           role="button">
                            Pridať produkt
                        </a>
                    </li>
                </ul>
            </div>

        </nav>
        <div class="col-md-2 col-4 mt-4 order-2 order-md-2 d-flex justify-content-end ">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button href="route('logout')" class="btn btn-outline-light button_style btn-sm text-nowrap m-2"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                    Odhlásiť sa
                </button>

            </form>

        </div>
    </div>
</header>

<main class="content">

    @yield('content')

</main>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="{{asset('js/admin_product_detail.js')}}"></script>
<script src="{{asset('js/admin_new_product.js')}}"></script>
<script type="text/javascript"> selectedPhoto()</script>
</body>
</html>
