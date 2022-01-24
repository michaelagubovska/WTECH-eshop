@extends('app')
@section('title', 'Košík')
@section('content')
    <?php
    use Illuminate\Support\Facades\Auth;
    $summary = 0;
    $shipping = 0;
    $payment = 0;
    $empty_cart = True;
    $user_id = Auth::id();
    if($user_id){
        if(!$cart_products->isEmpty()) {
            $empty_cart = False;
        }
    }
    else{
        if(count($cart_products_session)!=0){
            $empty_cart = False;
        }
    }
    ?>
    @if(!$empty_cart)

        <main>

            <div class="container bg-white mb-3">
                <!-- Cart navigation -->
                <section class="row">
                    <ul class="d-flex col-12 justify-content-center nav nav-tabs" id="carttabs">
                        <li class="nav-item">
                            <a href="#summary" class="nav-link active cart_tab_item" data-bs-toggle="tab">
                                <div class="row align-items-center cart_step">
                                    <div class="col-5 tab_label_img">
                                        <img class="cart_step_img" src="images/cart-1.png" width="25px"
                                             alt="Prehľad košíka">
                                    </div>
                                    <div class="col-7 tab_label">
                                        Košík
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#shipping" class="nav-link cart_tab_item" data-bs-toggle="tab">
                                <div class="row align-items-center cart_step">
                                    <div class="col-5 tab_label_img">
                                        <img class="cart_step_img" src="images/cart-2.png" width="25px" alt="Doručenie">
                                    </div>
                                    <div class="col-7 tab_label">
                                        Doprava
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#payment" class="nav-link cart_tab_item" data-bs-toggle="tab"
                               id="tab_payment_item">
                                <div class="row align-items-center cart_step">
                                    <div class="col-5 tab_label_img">
                                        <img class="cart_step_img" src="images/cart-3.png" width="25px" alt="Platba">
                                    </div>
                                    <div class="col-7 tab_label">
                                        Platba
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </section>

                <!-- Cart Tabs -->
                <div class="tab-content">
                    <!-- cart summary tab -->
                    <section class="tab-pane fade show active" id="summary">
                        <!-- Header of cart summary -->
                        <div class="row mb-3 mt-3 cart-header">
                            <div class="col-xl-6 col-md-4">Produkt</div>
                            <div class="col-xl-1 col-md-2">Cena</div>
                            <div class="d-flex col-xl-2 col-md-3 justify-content-center">Počet kusov</div>
                            <div class="col-xl-2 col-md-2">Cena spolu</div>
                        </div>
                        <hr>

                        <!-- product summary cell -->
                        @auth
                            @for($i=0;$i<count($cart_products);$i++)
                                <?php $p = $products->clone()->where('id', '=', $cart_products[$i]->pc_product_id)->first()?>
                                <article class="row product_in_cart_cell align-items-center">
                                    <div class="col-md-2 col-6">
                                        <img class="img-fluid" src={{$p->photo[0]->path}} alt="productphoto">
                                    </div>  <!-- fotka produktu -->
                                    <div class="col-xl-4 col-l-3 col-md-2 col-6">
                                        <div class="text-truncate cart_name">
                                            {{$p->name}}
                                        </div>
                                        <div class="text-muted">
                                            {{$p->color->name}}
                                            <br>
                                            {{$cart_products[$i]->pc_size}}
                                        </div>

                                    </div>
                                    <div class="col-6 cart-description-small">Cena :</div>
                                    <div class="col-xl-1 col-l-1 col-md-2 col-6">{{$p->price}} €</div>
                                    <!-- cena za kus -->
                                    <div class="col-5 cart-description-small">Počet kusov :</div>
                                    <div class="col-xl-2 col-md-3 col-7">
                                        <div class="row product_amount_count align-items-center">
                                            <form method="post">
                                                <input type="hidden" name="m" value="update">
                                                <div class="input-group-sm mt-3 center n_pieces">

                                                    @csrf
                                                    @if($cart_products[$i]->quantity==1)
                                                        <span class="input-group-prepend">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="minus" disabled
                                                            data-field="{{$cart_products[$i]->id}}">
                                                        <b> - </b>
                                                    </button>
                                                </span>
                                                    @else
                                                        <span class="input-group-prepend">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="minus" data-field="{{$cart_products[$i]->id}}">
                                                        <b> - </b>
                                                    </button>
                                                </span>
                                                    @endif
                                                    <input type="text" class="form-control input-number text-center"
                                                           name="{{$cart_products[$i]->id}}"
                                                           value="{{$cart_products[$i]->quantity}}"
                                                           min="1" readonly
                                                           max="{{$cart_products[$i]->inventory->quantity}}">

                                                    @if($cart_products[$i]->inventory->quantity==0)
                                                        <span class="input-group-append">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="plus" disabled
                                                            data-field="{{$cart_products[$i]->id}}">
                                                        <b>+</b>
                                                    </button>
                                                </span>
                                                    @else
                                                        <span class="input-group-append">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="plus" data-field="{{$cart_products[$i]->id}}">
                                                        <b>+</b>
                                                    </button>
                                                </span>
                                                    @endif

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-6 cart-description-small">Cena spolu :</div>
                                    <div class="col-xl-2 col-md-2 col-6">{{$p->price*$cart_products[$i]->quantity}}€
                                    </div>
                                    <!-- cena spolu za kusy -->
                                    <?php $summary += $p->price * $cart_products[$i]->quantity ?>
                                    <div class="d-flex justify-content-end col-xl-1 col-md-1 col mt-4 mt-md-0">
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" name="m" value="delete">

                                            <button class="x_button" type="submit" name="remove"
                                                    value="{{$cart_products[$i]->id}}">
                                                <img class="img-fluid" src="images/x_icon.png" width="20px" alt="removeItem">
                                            </button>
                                        </form>
                                    </div>  <!-- ikonka X pre odstranenie z kosika -->
                                </article>
                                <hr>
                        @endfor
                        @endauth

                        @guest
                            @for($i=0;$i<count($cart_products_session);$i++)
                                <?php $p = $products->clone()->where('id', '=', $cart_products_session[$i]['pc_product_id'])->first();
                                $p_inventory = App\Models\Inventory::where('id','=',$cart_products_session[$i]['product_inventory_id'])->first();
                                ?>
                                <article class="row product_in_cart_cell align-items-center">
                                    <div class="col-md-2 col-6">
                                        <img class="img-fluid" src={{$p->photo[0]->path}} alt="productphoto">
                                    </div>  <!-- fotka produktu -->
                                    <div class="col-xl-4 col-l-3 col-md-2 col-6">
                                        <div class="text-truncate cart_name">
                                            {{$p->name}}
                                        </div>
                                        <div class="text-muted">
                                            {{$p->color->name}}
                                            <br>
                                            {{$cart_products_session[$i]['pc_size']}}
                                        </div>

                                    </div>
                                    <div class="col-6 cart-description-small">Cena :</div>
                                    <div class="col-xl-1 col-l-1 col-md-2 col-6">{{$p->price}} €</div>
                                    <!-- cena za kus -->
                                    <div class="col-5 cart-description-small">Počet kusov :</div>
                                    <div class="col-xl-2 col-md-3 col-7">
                                        <div class="row product_amount_count align-items-center">
                                            <form method="post">
                                                <input type="hidden" name="m" value="update">
                                                <div class="input-group-sm mt-3 center n_pieces">

                                                    @csrf
                                                    @if($cart_products_session[$i]['quantity']==1)
                                                        <span class="input-group-prepend">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="minus" disabled
                                                            data-field="{{$i}}">
                                                        <b> - </b>
                                                    </button>
                                                </span>
                                                    @else
                                                        <span class="input-group-prepend">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="minus" data-field="{{$i}}">
                                                        <b> - </b>
                                                    </button>
                                                </span>
                                                    @endif
                                                    <input type="text" class="form-control input-number text-center"
                                                           name="{{$i}}"
                                                           value="{{$cart_products_session[$i]['quantity']}}"
                                                           min="1" readonly
                                                           max="{{$p_inventory->quantity}}">

                                                    @if($p_inventory->quantity==$cart_products_session[$i]['quantity'])
                                                        <span class="input-group-append">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="plus" disabled
                                                            data-field="{{$i}}">
                                                        <b>+</b>
                                                    </button>
                                                </span>
                                                    @else
                                                        <span class="input-group-append">
                                                    <button type="submit" class="btn btn-outline-light button_style"
                                                            name="plus" data-field="{{$i}}">
                                                        <b>+</b>
                                                    </button>
                                                </span>
                                                    @endif

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-6 cart-description-small">Cena spolu :</div>
                                    <div class="col-xl-2 col-md-2 col-6">{{$p->price*$cart_products_session[$i]['quantity']}}€
                                    </div>
                                    <!-- cena spolu za kusy -->
                                    <?php $summary += $p->price * $cart_products_session[$i]['quantity'] ?>
                                    <div class="d-flex justify-content-end col-xl-1 col-md-1 col mt-4 mt-md-0">
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" name="m" value="delete">

                                            <button class="x_button" type="submit" name="remove"
                                                    value="{{$i}}">
                                                <img class="img-fluid" src="images/x_icon.png" width="20px" alt="removeItem">
                                            </button>
                                        </form>
                                    </div>  <!-- ikonka X pre odstranenie z kosika -->
                                </article>
                                <hr>
                        @endfor
                        @endguest
                    <!-- Total summary -->
                        <div class="cart_summary my-3">
                            <div class="row align-items-center my-2">
                                <div class="col-lg-7 col-md-6 col-1"></div>
                                <div class="d-flex col-lg-2 col-md-2 col-4 justify-content-end">CENA SPOLU:</div>
                                <div class="col-lg-2 col-md-2 col-6">{{$summary}} €</div>
                                <div class="col-lg-1 col-md-2 col-1"></div>
                            </div>
                            <div class="row align-items-center my-2">
                                <div class="col-lg-7 col-md-6 col-1"></div>
                                <div class="d-flex col-lg-2 col-md-2 col-4 justify-content-end">Z toho DPH:</div>
                                <div class="col-lg-2 col-md-2 col-6">{{$summary*0.2}} €</div>
                                <div class="col-lg-1 col-md-2 col-1"></div>
                            </div>
                            <div class="row align-items-center my-2">
                                <div class="col-lg-9 col-md-8 col-8"></div>
                                <div class="d-flex col-lg-3 col-md-4 col-4 justify-content-end">
                                    <button class="btn btn-outline-light button_style" id="continuetoshippingbutton">
                                        POKRAČOVAŤ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end of cart summary tab -->

                    <!-- shipping tab -->
                    <section class="tab-pane fade" id="shipping" aria-selected="true">
                        @guest
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col ms-2 shipping_section_title">Adresa doručenia</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mt-2 ">
                                                <input type="text" class="form-control" id="floatingName"
                                                       placeholder="first_name">
                                                <label for="floatingName">Krstné meno</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mt-2 ">
                                                <input type="text" class="form-control" id="floatingLastName"
                                                       placeholder="last_name">
                                                <label for="floatingLastName">Priezvisko</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mt-2 ">
                                        <input type="text" class="form-control" id="floatingAddress" placeholder="address">
                                        <label for="floatingAddress">Ulica a číslo domu</label>
                                    </div>
                                    <div class="form-floating mt-2 ">
                                        <input type="text" class="form-control" id="floatingAddressDetail"
                                               placeholder="address_detail" >
                                        <label for="floatingAddressDetail">Upresnenie adresy (nepovinné)</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mt-2 ">
                                                <input type="text" class="form-control" id="floatingCity"
                                                       placeholder="city">
                                                <label for="floatingCity">Mesto</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mt-2 ">
                                                <input type="text" class="form-control" id="floatingZipCode"
                                                       placeholder="zip_code">
                                                <label for="floatingZipCode">PSČ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mt-2 ">
                                        <input type="text" class="form-control" id="floatingPhoneNumber"
                                               placeholder="phone_number">
                                        <label for="floatingPhoneNumber">Telefónne číslo</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col ms-2 shipping_section_title">Sem Vám pošleme potvrdenie o objendávke
                                        </div>
                                    </div>
                                    <div class="form-floating mt-2 ">
                                        <input type="text" class="form-control" id="floatingEmail" placeholder="email">
                                        <label for="floatingEmail">Email</label>
                                    </div>
                                    <div class="row">
                                        <div class="col ms-2 mb-2 shipping_section_title">Spôsob doručenia</div>
                                    </div>
                                    <form>
                                        <div class="row shipping_option mb-2">
                                            <div class="col-8 col-lg-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shippingRadio"
                                                           id="flexRadioGLS" value=3.9 checked>
                                                    <label class="form-check-label" for="flexRadioGLS">
                                                        Kuriér GLS
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex col-4 col-lg-2 justify-content-end">€ 3,90</div>
                                        </div>

                                        <div class="row shipping_option mb-2">
                                            <div class="col-8 col-lg-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shippingRadio"
                                                           id="flexRadioExpresGLS" value=4.9>
                                                    <label class="form-check-label" for="flexRadioExpresGLS">
                                                        Expres kuriér GLS
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex col-4 col-lg-2 justify-content-end">€ 4,90</div>
                                        </div>

                                        <div class="row shipping_option mb-2">
                                            <div class="col-8 col-lg-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shippingRadio"
                                                           id="flexRadioZasielkovna" value=1.8>
                                                    <label class="form-check-label" for="flexRadioZasielkovna">
                                                        Zásielkovňa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex col-4 col-lg-2 justify-content-end">€ 1,80</div>
                                        </div>
                                    </form>
                                    <div class="row my-3">
                                        <div class="d-flex col justify-content-end">
                                            <button class="btn btn-outline-light button_style" id="continuetopaymentbutton">
                                                POKRAČOVAŤ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endguest
                        @auth
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col ms-2 shipping_section_title">Adresa doručenia</div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mt-2 ">
                                            <input type="text" class="form-control" id="floatingName"
                                                   placeholder="first_name" value="{{$user->name}}">
                                            <label for="floatingName">Krstné meno</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mt-2 ">
                                            <input type="text" class="form-control" id="floatingLastName"
                                                   placeholder="last_name" value="{{$user->last_name}}">
                                            <label for="floatingLastName">Priezvisko</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mt-2 ">
                                    <input type="text" class="form-control" id="floatingAddress" placeholder="address"
                                           value="{{$user->street}}">
                                    <label for="floatingAddress">Ulica a číslo domu</label>
                                </div>
                                <div class="form-floating mt-2 ">
                                    <input type="text" class="form-control" id="floatingAddressDetail"
                                           placeholder="address_detail" value="{{$user->additional_info}}">
                                    <label for="floatingAddressDetail">Upresnenie adresy (nepovinné)</label>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mt-2 ">
                                            <input type="text" class="form-control" id="floatingCity"
                                                   placeholder="city" value="{{$user->city}}">
                                            <label for="floatingCity">Mesto</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mt-2 ">
                                            <input type="text" class="form-control" id="floatingZipCode"
                                                   placeholder="zip_code" value="{{$user->zip_code}}">
                                            <label for="floatingZipCode">PSČ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mt-2 ">
                                    <input type="text" class="form-control" id="floatingPhoneNumber"
                                           placeholder="phone_number" value="{{$user->phone_number}}">
                                    <label for="floatingPhoneNumber">Telefónne číslo</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col ms-2 shipping_section_title">Sem Vám pošleme potvrdenie o objendávke
                                    </div>
                                </div>
                                <div class="form-floating mt-2 ">
                                    <input type="text" class="form-control" id="floatingEmail" placeholder="email"
                                           value="{{$user->email}}">
                                    <label for="floatingEmail">Email</label>
                                </div>
                                <div class="row">
                                    <div class="col ms-2 mb-2 shipping_section_title">Spôsob doručenia</div>
                                </div>
                                <form>
                                    <div class="row shipping_option mb-2">
                                        <div class="col-8 col-lg-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="shippingRadio"
                                                       id="flexRadioGLS" value=3.9 checked>
                                                <label class="form-check-label" for="flexRadioGLS">
                                                    Kuriér GLS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex col-4 col-lg-2 justify-content-end">€ 3,90</div>
                                    </div>

                                    <div class="row shipping_option mb-2">
                                        <div class="col-8 col-lg-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="shippingRadio"
                                                       id="flexRadioExpresGLS" value=4.9>
                                                <label class="form-check-label" for="flexRadioExpresGLS">
                                                    Expres kuriér GLS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex col-4 col-lg-2 justify-content-end">€ 4,90</div>
                                    </div>

                                    <div class="row shipping_option mb-2">
                                        <div class="col-8 col-lg-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="shippingRadio"
                                                       id="flexRadioZasielkovna" value=1.8>
                                                <label class="form-check-label" for="flexRadioZasielkovna">
                                                    Zásielkovňa
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex col-4 col-lg-2 justify-content-end">€ 1,80</div>
                                    </div>
                                </form>
                                <div class="row my-3">
                                    <div class="d-flex col justify-content-end">
                                        <button class="btn btn-outline-light button_style" id="continuetopaymentbutton">
                                            POKRAČOVAŤ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endauth
                    </section>
                    <!-- end of shipping tab -->

                    <!-- payment tab -->
                    <section class="tab-pane fade" id="payment">
                        <div class="row my-4">
                            <div class="col-md-7">
                                <h6 class="payment_summary">Spôsob platby</h6>
                                <div class="payment_option">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentRadio"
                                               id="flexRadioKarta" value="0" checked>
                                        <label class="form-check-label" for="flexRadioKarta">
                                            Platba kartou
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-floating mt-2 ">
                                                <input type="text" class="form-control" id="floatingCardNumber"
                                                       placeholder="card_number" required>
                                                <label for="floatingCardNumber">Číslo karty</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mt-2 ">
                                                <input type="text" class="form-control" id="floatingExpirationDate"
                                                       placeholder="expiration_date" required>
                                                <label for="floatingExpirationDate">Expirácia</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mt-2 ">
                                                <input type="text" class="form-control" id="floatingCVV"
                                                       placeholder="cvv" required>
                                                <label for="floatingCVV">CVV</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment_option">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paymentRadio"
                                                       id="flexRadioDobierka" value=1>

                                                <label class="form-check-label" for="flexRadioDobierka">
                                                    Platba na dobierku
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex col-4 justify-content-end">
                                            € 1,00
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h6 class="payment_summary">Zhrnutie</h6>
                                <div class="row payment_summary">
                                    <div class="col-8">Cena za tovar:</div>
                                    <div class="d-flex col-4 justify-content-end">
                                        <input type="text" class="input_cart" id="price_item" name="summaryItem"
                                               value="{{$summary}}" readonly>
                                    </div>
                                </div>
                                <div class="row payment_summary">
                                    <div class="col-8">Z toho DPH:</div>
                                    <div class="d-flex col-4 justify-content-end">
                                        <input type="text" class="input_cart" name="summaryItem"
                                               value="{{$summary*0.2}}" readonly>
                                    </div>
                                </div>
                                <div class="row payment_summary">
                                    <div class="col-8">Platba:</div>
                                    <div class="d-flex col-4 justify-content-end">
                                        <input type="text" class="input_cart" id="payment_item" name="summaryItem"
                                               value="0" readonly>
                                    </div>
                                </div>
                                <div class="row payment_summary">
                                    <div class="col-8">Doručenie:</div>
                                    <div class="d-flex col-4 justify-content-end">
                                        <input type="text" class="input_cart" id="shipping_item" value="3.9"
                                               name="summaryItem" readonly>
                                    </div>
                                </div>

                                <div class="row payment_summary">
                                    <div class="col-8">FINÁLNA CENA:</div>
                                    <div class="d-flex col-4 justify-content-end">
                                        <input type="text" class="input_cart" id="total_item" name="summaryItem"
                                               readonly>
                                    </div>
                                </div>
                                <div class="center">
                                    <p>Kliknutím na tlačidlo registrovať sa súhlasíte s <u>pravidlami a podmienkami</u>
                                        spoločnosti
                                        MERCHSORT s.r.o.</p>
                                </div>
                                <div class="row ">
                                    <div class="d-flex col justify-content-end">
                                        <button class="btn btn-outline-light button_style footer_button">OBJEDNAŤ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end of payment tab -->
                </div>
                <!-- end of tab content -->
            </div>
        </main>
    @else
        <main>
            <div class="container d-flex justify-content-center">
                <h1 class="justify-center h3 m-3">Váš košík je zatiaľ prázdny</h1>
            </div>
            <div class="container d-flex justify-content-center">
                <a href="/">
                    <button class="btn btn-outline-light button_style">Nakupovať</button>
                </a>
            </div>
        </main>
    @endif
@endsection
