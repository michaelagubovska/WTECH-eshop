<section class="owl-carousel owl-theme owl-nav product-slider">
    @foreach($productList as $product)
        <article class="card shadow-sm text-truncate">
            <a href="/product_detail?id={{$product->id}}" class="product_name">
                <img src="{{asset($product->photo[0]->path)}}" alt="productphoto">
                <div class="card-body">
                    <h1 class="h6">{{$product->name}}</h1>
                    <h1 class="h6 text-muted ">{{$product->color->name}}</h1>
                    <h1 class="h6">{{$product->price}}€</h1>
                </div>
            </a>
        </article>
    @endforeach
</section>
