@extends('Frontend.index')
@section('title', 'ByMe HomePage')

@section('konten')
<div class="container-fluid">
    <div class="swiper swiper-baju text-center">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="#">
                    <img class="img-fluid" src="{{ asset('images/banner1.jpg') }}" alt="Slide Image 1">
                </a>        
            </div>
            <div class="swiper-slide">
                <a href="#">
                    <img class="img-fluid" src="{{ asset('images/banner2.jpg') }}" alt="Slide Image 2">
                </a>                
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>


<div class="container px-5 mb-5">
    <h1 class="text-center mt-5 text-primary"><i class="fa-solid fa-grip-lines"></i> Pilihan Produk Kami <i class="fa-solid fa-grip-lines"></i> </h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 justify-content-center mt-5">
    @foreach($products as $product)
    <div class="col-2">
        <a href="{{ route('detail-produk', $product->id_produk) }}" class="card text-decoration-none border-0">
        <img src="{{ asset('images/1.jpg') }}" class="card-img-top object-fit-contain" alt="..." height="300">
        <div class="card-body p-0">
            <p class="card-text fs-5">{{ $product->deskripsi }}</p>
        </div>
        <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item text-secondary p-0 fw-bold">IDR {{ $product->harga }}</li>
        </ul>
        </a>
    </div>
    @endforeach
    </div>
</div>
@endsection