<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- MyCss --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="bg-info justify-content-end py-1 d-none d-md-flex">
      <div>&nbsp;</div>
      <div>&nbsp;</div>
    </div>
    @guest
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid byme-ff-poppins">
            <a class="navbar-brand" href="{{ route('home') }}">ByMe</a>            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Produk</a>
                </li>
              </ul>

              <div class="d-flex">
                <a href="{{ route('register-store') }}" class="btn btn-secondary text-white me-3">Daftar</a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary me-4">Login</a>
              </div>
            </div>
          </div>
      </nav>
    @endguest
    @auth
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid byme-ff-poppins">
          <a class="navbar-brand" href="{{ route('home') }}">ByMe</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Produk</a>
              </li>
            </ul>

            <div class="d-flex">
              <a href="{{ route('cart-list') }}" class="fs-5 me-3 text-center link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="fs-6">Cart</div>
              </a>
            </div>

            <div class="d-flex">
              <a href="{{ route('history-transaksi') }}" class="fs-5 me-3 text-center link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <div class="fs-6">Transaksi</div>
              </a>
            </div>
            
            <div class="d-flex">
              <a href="{{ route('logout') }}" class="fs-5 me-5 text-center link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                <i class="fa-solid fa-right-from-bracket"></i>
                <div class="fs-6">Logout</div>
              </a>
            </div>
          </div>
        </div>
      </nav>
    @endauth
    @yield('konten')

    <div class="container-fluid bg-primary text-white text-center py-4 km-footer">
      <span>ByMe is a property of Fariel. ©2023 All Rights Reserved.</span>
    </div>




    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    {{-- Swiper JS --}}
    <script src="{{asset('Swiper/swiper-bundle.min.js')}}"></script>

    {{-- Sweetalert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- myJS --}}
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>