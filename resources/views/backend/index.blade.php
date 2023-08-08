<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('csrf')
    <title>@yield('titleHalaman')</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Comfortaa:wght@300;400;500;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- myCss --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="vertical-nav navbar-dark km-ff-asap bg-primary" id="km-sidebar">
        <div class="text-center py-4">
            <a href="#" class="navbar-brand fs-5 text-white km-ff-comfortaa fw-bold">KiosManga Admin</a>
        </div>

        <ul class="flex-column navbar-nav ms-4 mb-0">
            <li class="nav-item km-bg-blue">
                <a href="#" class="nav-link km-fw-medium @yield('Produk')">
                    <i class="fa-solid fa-books me-3"></i>
                    &nbsp;Produk
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="#" class="nav-link km-fw-medium @yield('Kategori')">
                    <i class="fa-solid fa-pen-swirl me-3"></i>
                    &nbsp;Kategori
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="#" class="nav-link km-fw-medium @yield('Cart')">
                    <i class="fa-brands fa-product-hunt me-3"></i>
                    &nbsp;Cart
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="#" class="nav-link km-fw-medium @yield('Order')">
                    <i class="fa-solid fa-user-large me-3"></i>
                    &nbsp;Order
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="#" class="nav-link km-fw-medium @yield('User')">
                    <i class="fa-regular fa-list-dropdown me-3"></i>
                    &nbsp;User
                </a>
            </li>
        </ul>
        <ul class="flex-column navbar-nav ms-4 mt-3 mb-0">
            <li class="nav-item km-bg-blue">
                <a href="{{ route('logout') }}" class="nav-link km-fw-medium @yield('Keranjang')">
                    <i class="fa-solid fa-arrow-up-left-from-circle me-3"></i>
                    &nbsp;Logout
                </a>
            </li>
        </ul>
    </div>
    @yield('modalTambah')
    @yield('modalEdit')
    @yield('konten')

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    
    {{-- myJS --}}
    <script src="{{asset('src/js/script.js')}}"></script>

    {{-- Bootstrap JS --}}
    <script src="{{asset('/Bootstrap/dist/js/bootstrap.bundle.js')}}"></script>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    {{-- Sweetalert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>
</html>