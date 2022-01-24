<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/product_signing.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
<main>
    <div class="container">
        <section class="row">
            <div class="col mt-4">
                <div class="container-fluid">
                    <a href="/admin" class="navbar-brand mb-0 h1">
                        <img class="d-inline-block align-top" src="{{asset('images/logo.png')}}" alt="logoMerch" height="50px">
                    </a>
                </div>
            </div>

        </section>
        <section class="row">
            <div class="col-6 col-md-4 offset-3 offset-md-4">
                <h1 class="h3 mb-3 fw-normal center">Admin - Prihlásenie</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <form method="POST" action="{{ route('admin_login') }}">
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
            </div>
        </section>
    </div>
</main>
</body>
</html>
