@extends('admin')
@section('title', 'Zoznam produktov')
@section('content')

    <div class="container bg-white mt-5 mb-5">
        <!-- Search bar -->
        <nav>
            <form class="d-flex justify-content-start" action="product_list" method="get">
                <div class="col-s-4">
                    <input type="text" name="search_bar" value="" class="form-control search_bar" placeholder="Názov produktu">
                </div>
                <button type="submit" class="btn btn-outline-light button_style ms-2">Vyhľadať</button>
            </form>
        </nav>

        <!-- List header -->
        <section class="row mt-4 list-header">
            <div class="col-1 list-header-label">id</div>
            <div class="col-6 list-header-label">Produkt</div>
            <div class="col-3 list-header-label">Kategória</div>
            <div class="col-2 list-header-label"></div>
        </section>
        <hr>

        <!-- List cells -->
        <section>
            @foreach($products as $p)
            <article class="row align-items-center"> <!-- for each -->
                <div class="col-1 cell-description-small list-header-label">id:</div>
                <div class="col-2 col-sm-1">{{$p->id}}</div>
                <div class="col-9 col-sm-6">
                    <div class="text-truncate list_name">
                        {{$p->name}}
                    </div>
                    <div class="text-muted">
                        {{$p->color->name}}
                    </div>
                </div>
                <div class="col-3 cell-description-small list-header-label">Kategória:</div>
                <div class="col-6 col-sm-3 text-truncate list_name">{{$p->category->name}}</div>
                <form class="d-flex col-3 col-sm-2 justify-content-end" action="product_detail/{{$p->id}}" method="get">
                    <button type="submit" value="{{$p->id}}" class="btn btn-outline-light button_style">Detail</button>
                </form>
            </article>
        <hr>
            @endforeach
        </section>
    </div>
@endsection
