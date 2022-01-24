@extends('app')
@section('title', $product->name )
@section('content')
    <main>
        <!-- Beadcrumbs -->
        <nav class="container-fluid bg-light">
            <div class="container pt-1 bg-light">
                <ul class="breadcrumb mb-0">
                    <li><a href="/">Domov</a></li>
                    <li><a href="{{$product->category->id}}">{{$product->category->name}}</a></li>
                    <li class="active">{{$product->name}}</li>
                </ul>
            </div>
        </nav>
        <!-- End breadcrumbs -->
        <!--Images, Sizes, number od pieces, add to cart-->
        <div class="container mt-3 pt-2 pb-2">
            <div class="row mt-5">
                <!--Images-->
                <div class="col-12 col-md-6">
                    <div class="row">
                        <!--Main photo-->
                        <article class="col-10">
                            <fieldset id="f11" class="active">
                                <img class="img-fluid" alt="productphoto" src={{$product->photo[0]->path}}>
                            </fieldset>
                            @for($i=1;$i<count($product->photo);$i++)
                            <fieldset id="f{{$i+1}}1" class="">
                                <img class="img-fluid" alt="productphoto" src={{$product->photo[$i]->path}}>
                            </fieldset>

                            @endfor

                        </article>
                        <!--Thumbnails-->
                        <article class="col-2">
                            <div id="f1" class="tb tb-active"><img class="thumbnail-img img-fluid m-2" alt="productthumbnail"
                                                                   src={{$product->photo[0]->path}}></div>
                            @for($i=1;$i<count($product->photo);$i++)
                            <div id="f{{$i+1}}" class="tb"><img class="thumbnail-img img-fluid m-2" alt="productthumbnail"
                                                         src={{$product->photo[$i]->path}}></div>
                            @endfor
                        </article>
                    </div>
                </div>
                <!--Title, sizes, number od pieces, add button-->
                <section class="col-12 col-md-5 offset-md-1 d-flex  justify-content-center mt-sm-4">
                    <div class="row-cols-auto">
                        <h1 class="h2">{{$product->name}}</h1>
                        <h2 class="h4">{{$product->color->name}}</h2>
                            <form method="post">
                                <!--Sizes-->
                                @csrf
                                <div class="sizes mt-5 mb-5 pt-2 ">
                                        @foreach ($product->inventory as $inventory_record)
                                            @if ($inventory_record->quantity > 0)
                                                <label class="radio">
                                                    <input type="radio" name="size" required
                                                           value={{$inventory_record->size}} quantity={{$inventory_record->quantity}}>
                                                    <span class="ps-1">{{str_replace("_"," ",$inventory_record->size)}}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                </div>

                                <!--Number of pieces-->
                                <div class="row-cols-2 d-flex justify-content-start mt-3 mb-4">
                                    <p class="center justify-content-start"><b>Počet kusov </b></p>
                                    <div class="input-group-sm mt-3 center n_pieces">
                                        <!--Minus button-->
                                        <span class="input-group-prepend">
                                    <button type="button" id="minus"
                                            class="btn btn-outline-light button_style btn-number" disabled="disabled">
                                        <b> - </b>
                                    </button>
                                </span>
                                        <!--Counter label-->
                                        <label>
                                            <input type="text" id='numberpicker' name="quantity"
                                                   class="form-control input-number text-center"
                                                   value="1" min="1" max="20">
                                        </label>
                                        <!--Plus button-->
                                        <span class="input-group-append">
                                <button type="button" id="plus" class="btn btn-outline-light button_style btn-number">
                                    <b>+</b>
                                </button>
                            </span>
                                    </div>
                                </div>

                                <!--Price and add to cart button-->
                                <div class="row-cols-2 d-flex justify-content-start ">
                                    <p class="center"><b>{{$product->price}}€</b></p>
                                    <button id="add_cart_button_auth" class="btn btn-outline-light button_style" type="submit">Pridať
                                        do košíka
                                    </button>
                                </div>
                            </form>
                    </div>
                </section>
            </div>
            <!--Additional info about product-->
            <section class="row-cols-1 mt-2">
                <h1 class="h4 ">Kúsok, ktorý si zamiluje každý študent aj absolvent!</h1>
                <p>
                    <ins>Základné informácie:</ins>
                </p>
                <p id="add_info">
                    {{$product->information}}
                    <br>Vyrobené na Slovensku.
                    <br>Originálny merch tvojej fakulty!
                </p>
            </section>
        </div>

        <!-- Podobne Carousel -->
        <div class="album py-2 bg-light">
            <div class="container">
                <h1>Podobné produkty</h1>
                @include('carousel',  ['productList'=> $productPhotoList])
            </div>
        </div>
    </main>


@endsection
