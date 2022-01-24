@extends('app')
@if($categorized_products->isEmpty())
    @section('title', 'Žiadne výsledky')
@else
    @section('title', $categorized_products[0]->category->name)

@endif

@section('content')
    <main>
        <!--Product filtering-->
        <nav>
            <div id="filter_navbar">
                <div class="container bg-white">
                    <div class="row">
                        <div class="col-md-7 col-10 order-md-0 order-0">
                            <nav class="navbar navbar-expand-md navbar-light">
                                <div class="container-fluid">
                                    <button type="button" data-bs-toggle="collapse" data-bs-target="#filterNav"
                                            class="filter-toggler navbar-toggler"
                                            aria-controls="navbarNav" aria-expanded="false" aria-label="Zobraz filtre">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="filterNav">
                                        <form action="" method="get">
                                            <ul class="navbar-nav filter-navbar">
                                                <li class="nav-item dropdown">
                                                    <a href="#" class="nav-link dropdown-toggle nav_bar_item"
                                                       id="filterDropdownPrice" role="button"
                                                       data-bs-toggle="dropdown" aria-expanded="false">
                                                        Cena
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="text-lowercase max-price-text">Maximálna cena</li>
                                                        <input type="range" id="my-slider" name="price" min="5" max="50"
                                                               value="50" oninput="slider()">
                                                        <li id="slider-value">5</li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a href="#" class="nav-link dropdown-toggle nav_bar_item"
                                                       id="filterDropdownSize" role="button"
                                                       data-bs-toggle="dropdown" aria-expanded="false">
                                                        Veľkosť
                                                    </a>
                                                    <ul class="dropdown-menu checkbox-menu"
                                                        aria-labelledby="filterDropdownSize">
                                                        <li><input name="product_size" type="radio" value="xs">XS</li>
                                                        <li><input name="product_size" type="radio" value="s">S</li>
                                                        <li><input name="product_size" type="radio" value="m">M</li>
                                                        <li><input name="product_size" type="radio" value="l">L</li>
                                                        <li><input name="product_size" type="radio" value="xl">XL</li>
                                                        <li><input name="product_size" type="radio" value="xxl">XXL</li>
                                                        <li><input name="product_size" type="radio" value="one size">OneSize
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a href="#" class="nav-link dropdown-toggle nav_bar_item"
                                                       id="filterDropdownColor" role="button"
                                                       data-bs-toggle="dropdown" aria-expanded="false">
                                                        Farba
                                                    </a>
                                                    <ul class="dropdown-menu checkbox-menu"
                                                        aria-labelledby="filterDropdownColor">
                                                        <li><input name="product_color" type="radio" value="biela">Biela
                                                        </li>
                                                        <li><input name="product_color" type="radio" value="čierna">Čierna
                                                        </li>
                                                        <li><input name="product_color" type="radio" value="modrá">Modrá
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown sorting">
                                                    <a href="#" class="nav-link dropdown-toggle nav_bar_item"
                                                       id="sortDropdown" role="button"
                                                       data-bs-toggle="dropdown" aria-expanded="false">
                                                        Zoradiť
                                                    </a>
                                                    <ul id="price_filter" class="dropdown-menu checkbox-menu"
                                                        aria-labelledby="sortDropdown">
                                                        <li><input type="radio" name="order" value="ASC">Od
                                                            najlacnejšieho
                                                        </li>
                                                        <li><input type="radio" name="order" value="DESC">Od
                                                            najdrahšieho
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <button type="submit" id="btn_filter_zobraz"
                                                            class="btn btn-outline-light button_style ms-2">Zobraz
                                                    </button>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>

                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End product filtering -->
        @if(!$categorized_products->isEmpty())
            <div>
                <!-- Beadcrumbs -->
                <nav class="container-fluid bg-light">
                    <div class="container pt-1 bg-light">
                        <ul class="breadcrumb mb-0">
                            <li><a href="/">Domov</a></li>
                            <li class="active">{{$categorized_products[0]->category->name}}</li>
                        </ul>
                    </div>
                </nav>
                <!-- End breadcrumbs -->

                <!-- Products -->
                <div class="album py-5 bg-light">
                    <div class="container">
                        <h1>{{$categorized_products[0]->category->name}}</h1>
                        <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach($categorized_products as $product)
                                <article class="col">
                                    <a href="/product_detail?id={{$product->id}}" class="product product_name">
                                        <div class="card shadow-sm text-truncate">
                                            <img src={{asset($product->photo[0]->path)}} alt="productphoto">
                                            <div class="card-body">
                                                <h1 class="h6">{{$product->name}}</h1>
                                                <h1 class="h6 text-muted ">{{$product->color->name}}</h1>
                                                <h1 class="h6 ">{{$product->price}}€</h1>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </section>
                        {!! $categorized_products->appends($_GET)->links() !!}
                    </div>
                </div>

            </div>
        @else
            <div class="container">
                <h1 class="justify-center h3 m-3">Žiadne výsledky</h1>
            </div>
        @endif
    </main>
@endsection
