@extends('app')
@section('title', 'Merchsort')
@section('content')
    <main>
        <!-- Novinky Carousel -->
        <section class="album py-2 bg-light">
            <div class="container">
                <h1>Novinky</h1>
                @include('carousel',  ['productList'=> array_slice($productPhotoList->getIterator()->getArrayCopy(),0,5)])
            </div>
        </section>
        <!-- End of Novinky Carousel-->

        <!--Banner-->
        <article class="container">
            <div class="row">
                <div class="col-sm-8 col-7 banner_text">
                    <b>ZAREGISTRUJ SA A ZÍSKAJ 20% ZĽAVU NA CELÝ NÁKUP!</b>
                </div>
                <div class="col-sm-4 col-5 banner_column">
                    <form action="register" method="get">
                        <button class="btn btn-outline-light footer_button button_style banner_button">Registrovať sa</button>
                    </form>
                </div>
            </div>
        </article>


        <!-- Odporucame Carousel -->
        <section class="album py-2 bg-light">
            <div class="container">
                <h1>Odporúčame</h1>

                @include('carousel',  ['productList' => array_slice($productPhotoList->getIterator()->getArrayCopy(),5)])
            </div>
        </section>
        <!-- End of Odporucame Carousel-->
    </main>
@endsection
