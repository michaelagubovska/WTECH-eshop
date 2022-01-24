@extends('admin')
@section('title', $product->name )
@section('content')
    <div class="container bg-white mt-5 mb-5">
        <div class="row">
            <section class="col-12 col-md-6" id="product_images">

                <div>
                    <nav class="col-12" id="imagesNav">
                        <form method="post" class="mt-1">
                            <input type="hidden" name="m" value="photo_dump">
                            @csrf
                            <div class="row">
                                <div class=" d-flex align-items-center justify-content-center">
                                    <label class="me-1">Vybrať obrázok</label>
                                    <select id="product_images_detail" class="form-control" name="photo_path">
                                        @foreach($product->photo as $photo){
                                        <option value="{{$photo->path}}">{{$photo->name}}</option>
                                        }
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-center justify-content-center text-nowrap">
                                    @if(count($product->photo)>1)
                                        <button type="submit" id="btnRemoveImage" class="mt-2">Odstrániť obrázok
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </nav>
                </div>

                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-6 mt-1">

                        <img id="detail_photo" src="{{asset($product->photo[0]->path)}}" alt="productphoto">

                    </div>
                </div>


                <div class="col-12 mb-2">
                    @if(count($product->photo)<4)
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="m" value="upload_photo">
                            @csrf
                            <div class="form-group row">
                                <label for="fileChooserAdminProductDetail" class="col-12 ps-3">Nahrať ďalší obrázok</label>
                                <input type="file" class="form-control custom-file-input col-12 ms-3 mt-1"
                                       id="fileChooserAdminProductDetail" name="photo_selector">
                                <section class="col-12 ps-3 mt-1">
                                    <button type="submit" id="btnSaveChanges">Pridať</button>
                                </section>

                            </div>
                        </form>
                    @endif
                </div>
            </section>

            <section class="col-12 col-md-6" id="product_informartion">
                <form method="post">
                    <input type="hidden" name="m" value="product_update">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h1 class="h6">Názov :</h1>
                        </div>
                        <div class="col-8">
                            <input type="text" class="input_admin_product_detail form-control" id="product_name_detail"
                                   name="admin_product_name" value="{{$product->name}}">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h1 class="h6">Popis :</h1>
                        </div>
                        <div class="col-8">
                            <input type="text" class="input_admin_product_detail form-control" id="product_name_information"
                                   name="admin_product_information" value="{{$product->information}}">
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h1 class="h6">Kategória :</h1>
                        </div>
                        <div class="col-8">
                            <input type="text" class="input_admin_product_detail form-control"
                                   id="product_category_detail" name="admin_product_info"
                                   value="{{$product->category->name}}" readonly>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h1 class="h6 d-flex align-items-center justify-content-end">Farba :</h1>
                        </div>
                        <div class="col-8">
                            <input type="text" class="input_admin_product_detail form-control" id="product_color_detail"
                                   name="admin_product_info" value="{{$product->color->name}}" readonly>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h1 class="h6">Cena :</h1>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" id="product_price_detail"
                                   name="admin_product_price" min="1" step="0.01" value="{{$product->price}}">
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h1 class="h6">Veľkosť :</h1>
                        </div>
                        <div class="col-8">
                            <div class="sizes mt-5 mb-5 pt-2 ">
                                <?php
                                $sizes = [];
                                if (in_array($product->product_category_id, [1, 2, 3, 4])) {
                                    $sizes_clothes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
                                } elseif ($product->product_category_id == 5) {
                                    $sizes_clothes = ['500ml', '750ml'];
                                } elseif ($product->product_category_id == 6) {
                                    $sizes_clothes = ['one_size'];
                                } elseif ($product->product_category_id == 7) {
                                    $sizes_clothes = ['20l', '50l'];
                                }
                                ?>
                                @foreach ($product->inventory as $inventory_record)
                                    <label class="radio">
                                        <input type="radio" name="admin_size" required
                                               value="{{$inventory_record->size}}"
                                               quantity={{$inventory_record->quantity}}>
                                        <span class="ps-1">{{str_replace("_"," ",$inventory_record->size)}}</span>
                                    </label>
                                    <?php array_push($sizes, $inventory_record->size)?>
                                @endforeach
                                @foreach($sizes_clothes as $s)
                                    @if(!in_array($s,$sizes))
                                        <label class="radio">
                                            <input type="radio" name="admin_size" required
                                                   value="{{$s}}" quantity=0>
                                            <span class="ps-1">{{str_replace("_"," ",$s)}}</span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h1 class="h6">Počet kusov :</h1>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" step="1" id="product_quantity_detail"
                                   name="admin_product_quantity" min="0">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <section class="col-12 d-flex justify-content-end">
                            <button type="submit" id="btnSaveChanges">Uložiť zmeny</button>
                        </section>
                    </div>
                </form>
            </section>
        </div>

        <div class="row mt-2">
            <form class="d-flex justify-content-end mb-2 text-nowrap" method="post">
                <input type="hidden" name="m" value="remove_product">
                @csrf
                <button type="submit" id="btnRemoveProduct">Odstrániť produkt</button>
            </form>

        </div>
    </div>
@endsection
