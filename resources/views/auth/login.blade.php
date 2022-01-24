@extends('app')
@section('title', 'Prihlásiť sa')
@section('content')
    <main class=" row me-0 " id="login_main">
        <section class="col-6 col-md-4 offset-3 offset-md-4">
            <h1 class="h3 mb-3 fw-normal center">Prihlásiť sa</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')"/>

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required autofocus/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Heslo')"/>

                    <x-input id="password" class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required autocomplete="current-password"/>
                </div>

                <div class="flex items-center justify-end mt-4">

                    <button class="btn btn-sm btn-light button_style text-center">
                        {{ __('Prihlásiť sa') }}
                    </button>
                </div>
            </form>
        </section>
    </main>
@endsection
