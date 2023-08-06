<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ByMe - Update Produk</title>

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
    <a href="{{ url('/admin') }}">ByMe</a>
    <p>Ubah Data Produk</p>
    <form action="{{ route('update-product', $products->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="div_design">
            <label for="title">Nama Produk</label>
            <input class="" value="{{ $products->nama_produk }}"   type="text" name="editProductName" placeholder="Write a title">
        </div>
        <div class="div_design">
            <label for="description">Deskripsi Produk</label>
            <input class="" value="{{ $products->deskripsi }}"  type="text" name="editDeskripsi" placeholder="Write a description">
        </div>
        <div class="div_design">
            <label for="price">Harga produk</label>
            <input class="" value="{{ $products->harga }}"  type="number" name="editHarga" placeholder="Write a price">
        </div>
        <div class="div_design">
            <label for="quantity">Jumlah produk</label>
            <input class="" value="{{ $products->jumlah }}"  type="text" name="editJumlah" placeholder="Write a quantity">
        </div>
        <div class="div_design">
            <label for="category">Kategori produk</label>
            <select class="" name="editCategoryName" id="">
                <option value="{{ $products->id_category}}" selected="">{{ $products->category->nama_category }}</option>
                @foreach ($categories as $category)
                 <option value="{{ $category->id_category }}">{{ $category->nama_category }}</option>   
                @endforeach
            </select>
        </div>
        <div class="div_design">
            <label for="editGambar">Gambar produk saat ini</label>
            <img class="img-center" height="100" src="/images/produk/{{ $products->gambar }}" alt="{{ $products->gambar }}">
        </div>
        <div class="div_design">
            <label for="editGambar">Ubah gambar produk</label>
            <input type="file" name="editGambar">
        </div>
        <div class="div_design">
            <input type="submit" value="update products" class="btn btn-primary">
        </div>
    </form>


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