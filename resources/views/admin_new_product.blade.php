@extends('admin')
@section('title', 'Nový produkt')
@section('content')

    <div class="container bg-white mt-5 mb-5">
            <div class="row">
                <section class="col-md-6 offset-md-3">
                    <h1 class="text-center">Pridať nový produkt</h1>
                    <form method="post" id="admin_new_product_form" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-2">
                            <label for="productTitle"><b>Názov produktu</b></label>
                            <input type="text" class="form-control" id="productTitle" required name="new_product_title">
                        </div>
                        <div class="mt-2">
                            <label for="productInformation"><b>Popis</b></label>
                            <input type="text" class="form-control" id="productInformation" required name="new_product_information">
                        </div>
                        <div class="mt-2">
                            <label for="productPrice"><b>Cena</b></label>
                            <input type="number" class="form-control" id="productPrice" required name="new_product_price">
                        </div>

                        <div class="mt-2">
                            <label for="productCategory"><b>Kategória</b></label>
                            <select class="custom-select form-control" id="productCategory" name="new_product_category">
                                <option value="1">Mužské mikiny</option>
                                <option value="2">Mužské tričká</option>
                                <option value="3">Ženské mikiny</option>
                                <option value="4">Ženské tričká</option>
                                <option value="5">Fľaše</option>
                                <option value="6">Čiapky</option>
                                <option value="7">Ruksaky</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="productColor"><b>Farba</b></label>
                            <select class="custom-select form-control" id="productColor" name="new_product_color">
                                <option value="1">Čierna</option>
                                <option value="2">Biela</option>
                                <option value="3">Modrá</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="productFile"><b>Fotky</b></label>
                            <input type="file" class="form-control custom-file-input" id="new_product_file" name="new_product_file[]" multiple required>
                        </div>
                        <div class="col-12 flex justify-center mt-4">
                            <button type="submit" class="btn btn-sm btn-light button_style text-center">Pridať produkt
                            </button>
                        </div>
                    </form>
                </section>
            </div>
    </div>
@endsection
