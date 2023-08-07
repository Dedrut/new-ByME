@extends('Frontend.index')
@section('title', 'ByMe Produk-'.$products->nama_produk)
@section('konten')
<div class="container my-5">
  <div class="row row-cols-2 justify-content-center">
    <div class="col-lg-4">
      <img src="{{ asset('images/2.jpg') }}" class="img-fluid" alt="Gambar">
    </div>

    <div class="col-lg-3">
      <div class="">
          <span class="bg-info rounded-5 p-1 px-2 text-white fw-medium">{{ $products->category->nama_category}}</span>
      </div>
      <div class="nama-baju text-uppercase fw-light fs-2">{{ $products->nama_produk }}</div>
      <div class="mt-3">
          <span class="bg-secondary rounded-2 p-1 px-2 text-white fw-medium fs-5">IDR {{ $products->harga }}</span>
      </div>
      <hr class="border border-1 border-primary my-4">

      <form action="{{ route('to-cart', $products->id_produk) }}" class="row" method="POST">
        @csrf
        <div class="col-5">
            <label class="fw-medium mb-2">JUMLAH</label>
            <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $products->jumlah }}">
        </div>
        <div class="col-12 d-grid gap-2 mt-4">
            <button class="btn btn-primary rounded-1 km-fw-medium text-white fw-medium fs-5" type="submit">Tambah Keranjang</button>                            
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

