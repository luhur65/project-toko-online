<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="{{ $setting->deskripsi ?? env('DESCRIPTION') }}">

    <meta name="keywords" content="{{ $setting->keyword ?? env('KEYWORDS') }}">


    <title>{{ $setting->website ?? env('WEBNAME') }} | {{ $setting->tagline ?? env('TAGLINE') }}</title>

    <link rel="shortcut icon" href="{{ $setting->logo ?? env('LOGO') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-67dcdfd2.css') }}">

    {{-- reflow --}}
    {{-- <link rel="stylesheet" href="https://cdn.reflowhq.com/v2/toolkit.min.css"> --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ $setting->website ?? env('WEBNAME') }}
                </a>
                <button class="navbar-toggler border-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <form class="container-fluid my-2 px-0" method="get" action="{{ route('/') }}">
                    {{-- @csrf --}}
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari barang mu ya ..." autocomplete="off" name="keyword" autofocus>
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-search fa-fw"></i>
                        </span>
                    </div>
                </form>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item mx-2 my-1">
                                    <a class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item mx-2 my-1">
                                    <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img style="width: 2.5rem" class="img-fluid rounded-circle" src="{{ asset('/storage/logo/'.$setting->logo??env('LOGO')) }}" alt="" srcset="">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route(auth()->user()->role . '.home') }}">
                                        <i class="fas fa-home fa-fw"></i>
                                        {{ __('Home') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="fas fa-user fa-fw"></i>
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('cart.index') }}">
                                        <i class="fas fa-shopping-cart fa-fw"></i>
                                        {{ __('Cart') }}

                                        {{-- @if (auth()->user()->countCart() > 0) --}}
                                            <span class="badge bg-danger rounded-pill">{{ auth()->user()->countCart() }}</span>
                                        {{-- @endif --}}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('order.index') }}">
                                        <i class="fas fa-shopping-bag fa-fw"></i>
                                        {{ __('Order') }}

                                        <span class="badge bg-danger rounded-pill">{{ auth()->user()->countOrder() }}</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('wishlist.index') }}">
                                        <i class="fas fa-heart fa-fw"></i>
                                        {{ __('Wishlist') }}

                                        <span class="badge bg-danger rounded-pill">{{ auth()->user()->countWishlist() }}</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('setting.index') }}">
                                        <i class="fas fa-gear fa-fw"></i>
                                        {{ __('Setting') }}
                                    </a>

                                    <hr>

                                    <a class="btn btn-danger btn-sm mx-3 w-50" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        {{-- footer --}}
        <footer class="mt-5">
            <div class="container-fluid bg-white">
                <div class="container">
                    <div class="row py-5">
                        <div class="col-md-4">
                            <h5 class="fw-bold mb-0">{{ $setting->website ?? env('WEBNAME') }}</h5> <i class="fw-bold text-muted">{{ env('TAGLINE') ?? $setting->tagline }}</i>
                            <p class="mt-2">
                                {{ $setting->deskripsi ?? env('DESCRIPTION') }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="fw-bold">Kontak</h5>
                            <div>
                                <i class="fas fa-envelope fa-fw"></i>
                                <a class="text-decoration-none" href="mailto:{{ $setting->email ?? env('EMAIL') }}">{{ $setting->email ?? env('EMAIL') }}</a>
                            </div>
                            <div>
                                <i class="fas fa-phone fa-fw"></i>
                                <a class="text-decoration-none" href="tel:{{ $setting->telepon ?? env('PHONE') }}">{{ $setting->telepon ?? env('PHONE') }}</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="fw-bold">Sosial Media</h5>
                            <div>
                                <i class="fab fa-facebook fa-fw"></i>
                                <a class="text-decoration-none" href="https://facebook.com/{{ $setting->facebook ?? env('FACEBOOK') }}">{{ $setting->facebook ?? env('FACEBOOK') }}</a>
                            </div>
                            <div>
                                <i class="fab fa-instagram fa-fw"></i>
                                <a class="text-decoration-none" href="https://instagram.com/{{ $setting->instagram ?? env('INSTAGRAM') }}">{{ $setting->instagram ?? env('INSTAGRAM') }}</a>
                            </div>
                            <div>
                                <i class="fab fa-twitter fa-fw"></i>
                                <a class="text-decoration-none" href="https://twitter.com/{{ $setting->twitter ?? env('TWITTER') }}">{{ $setting->twitter ?? env('TWITTER') }}</a>
                            </div>
                            <div>
                                <i class="fab fa-youtube fa-fw"></i>
                                <a class="text-decoration-none" href="https://youtube.com/{{ $setting->youtube ?? env('YOUTUBE') }}">{{ $setting->youtube ?? env('YOUTUBE') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    {{-- message --}}
    @if (session('success'))
        <div class="swal-message-text-on-success d-none">{{ session('success') }}</div>
    @endif
    
    {{-- message --}}
    @if (session('error'))
        <div class="swal-message-text-on-error d-none">{{ session('error') }}</div>
    @endif

    <script src="{{ asset('build/assets/app-aa9fb56b.js') }}"></script>
    {{-- <script src="https://cdn.reflowhq.com/v2/toolkit.min.js" data-reflow-store="314184390" defer></script> --}}
    <script src="https://kit.fontawesome.com/860bc1ae25.js" crossorigin="anonymous"></script>
    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        const swalMessageSuccess = document.querySelector('.swal-message-text-on-success');
        const swalMessageError = document.querySelector('.swal-message-text-on-error');
        
        // sweetalert
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        if (swalMessageSuccess) {
            Toast.fire({
                icon: 'success',
                title: swalMessageSuccess.textContent
            });
        } 
        
        if (swalMessageError) {
            Toast.fire({
                icon: 'error',
                title: swalMessageError.textContent
            });
        } 

    </script>
    @stack('scripts')
</body>
</html>
