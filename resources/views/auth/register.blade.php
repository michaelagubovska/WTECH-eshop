@extends('app')
@section('title', 'Registrovať sa')
@section('content')
    <main>
        <section>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            <h1 class="h3 text-center d-flex justify-content-center">Registrácia</h1>
            <form method="POST" action="{{ route('register') }}">
                {!! csrf_field() !!}
                <div class="row m-4">
                    <div
                        class="col-xl-5 col-lg-9 col-12 offset-0 offset-lg-2 offset-xl-0 order-1 order-xl-0 mt-2 ms-xl-5 me-xl-5 mt-4 p-2 pe-5">

                        @csrf
                        <h1 class="h4">Kontaktné a doručovacie údaje</h1>
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Meno')"/>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                     required
                                     autofocus/>
                        </div>

                        <!-- Last Name -->
                        <div class="mt-4">
                            <x-label for="last_name" :value="__('Priezvisko')"/>

                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                     :value="old('last_name')" required autofocus/>
                        </div>

                        <!-- Telephone -->
                        <div class="mt-4">
                            <x-label for="phone_number" :value="__('Telefónne číslo')"/>

                            <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                     :value="old('phone_number')" required autofocus/>
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <x-label for="city" :value="__('Mesto')"/>

                            <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
                                     required
                                     autofocus/>
                        </div>

                        <!-- Street -->
                        <div class="mt-4">
                            <x-label for="street" :value="__('Ulica a číslo domu')"/>

                            <x-input id="street" class="block mt-1 w-full" type="text" name="street"
                                     :value="old('street')"
                                     required autofocus/>
                        </div>

                        <!-- Additional info -->
                        <div class="mt-4">
                            <x-label for="additional" :value="__('Dodatončné údaje k adrese (č.bytu a pod.)')"/>

                            <x-input id="additional" class="block mt-1 w-full" type="text" name="additional"
                                     :value="old('additional')"/>
                        </div>

                        <!-- Zip code -->
                        <div class="mt-4">
                            <x-label for="zip_code" :value="__('PSČ')"/>

                            <x-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code"
                                     :value="old('zip_code')"
                                     required autofocus/>
                        </div>
                    </div>
                    <div class="col-xl-5 col-12 order-0 order-xl-1  mt-xl-2 p-2 ">
                        <div class="row text-center d-flex justify-content-center mb-5">
                            <h1 class="h3 mb-4">Prečo sa registrovať?</h1>
                            <p>Získaš prístup k histórií svojich objednávok</p>
                            <p>Maj všetky faktúry od nás na jednom mieste</p>
                            <p>Urýchliš dokončenie objednávky, vďaka uloženým kontaktným a doručovacím údajom</p>
                            <p>Sleduj aktuálny stav svojej objednávky</p>
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-xl-12 col-lg-9 col-12 offset-0 offset-lg-2 offset-xl-0 pe-5">
                                <h1 class="h4 mb-3">Prihlasovacie údaje</h1>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')"/>

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                             :value="old('email')"
                                             required/>
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Heslo')"/>

                                    <x-input id="password" class="block mt-1 w-full"
                                             type="password"
                                             name="password"
                                             required autocomplete="new-password"/>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-label for="password_confirmation" :value="__('Potvrď heslo')"/>

                                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                             type="password"
                                             name="password_confirmation" required/>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row fit_to_page">
                    <div class="col-12 col-12 d-flex justify-center ">
                        <p>Kliknutím na tlačidlo registrovať sa súhlasíte s <u>pravidlami a podmienkami</u> spoločnosti
                            MERCHSORT s.r.o.</p>
                    </div>
                </div>
                <div class="row fit_to_page">
                    <div class="col-12 flex items-center justify-center mt-4 mb-4 ">
                        <button type="submit" class="btn btn-sm btn-light button_style text-center">Registrovať sa
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
