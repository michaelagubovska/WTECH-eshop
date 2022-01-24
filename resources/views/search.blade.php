@extends('app')
@if($categorized_products->isEmpty())
    @section('title', 'Žiadne výsledky')
@else
    @section('title', 'Výsledky vyhľadávania')

@endif

@section('content')
    <main>
        <!-- End product filtering -->
        @if(!$categorized_products->isEmpty())
            <div>

                <!-- Products -->
                <div class="album py-5 bg-light">
                    <div class="container">
                        <h1>Výsledky vyhľadávania pre "{{request('search_bar')}}"</h1>
                        <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach($categorized_products as $product)
                                <article class="col">
                                    <a href="/product_detail?id={{$product->id}}" class="product product_name">
                                        <div class="card shadow-sm text-truncate">
                                            <img src={{asset($product->photo[0]->path)}} alt="produkt">
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
