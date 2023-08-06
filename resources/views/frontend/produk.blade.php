<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ByMe</title>

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
    <div class="bg-primary justify-content-end py-1 d-none d-md-flex">
      <div>&nbsp;</div>
      <div>&nbsp;</div>
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid byme-ff-poppins">
          <a class="navbar-brand" href="#">Produk Page</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    @foreach($produk as $produk)
    <div class="container px-5 mb-5">
      <h1 class="text-center mt-5 text-primary"><i class="fa-solid fa-grip-lines"></i> Produk Kami <i class="fa-solid fa-grip-lines"></i> </h1>
      
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 justify-content-center mt-5">
        <div class="col-2">
          <a href="" class="card text-decoration-none border-0">
            <img src="{{ asset('images/1.jpg') }}" class="card-img-top object-fit-contain" alt="..." height="300">
            <div class="card-body p-0">
              <p class="card-text fs-5">Lorem ipsum dolor sit amet</p>
            </div>
            <ul class="list-group list-group-flush mt-2">
               <li class="list-group-item text-secondary p-0 fw-bold">IDR 50.000</li>
            </ul>
          </a>
        </div>
      </div>
    </div>
    @endforeach


    <div class="container-fluid bg-primary text-white text-center py-4 km-footer">
      <span>KiosManga is a property of Fariel. ©2023 All Rights Reserved.</span>
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