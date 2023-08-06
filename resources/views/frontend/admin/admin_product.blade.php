<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Produk</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- MyCss --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <style>
        .admin-product-size{
            width: 100px;
        }
    </style>
</head>
<body>
    <a href="{{ url('/admin') }}">ByMe</a>
    <p>Halaman Produk admin</p>
    <div class="responsive text-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Deskripsi Produk</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Jumlah Produk</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Gambar Produk</th>
                    <th scope="col">Ubah</th>
                    <th scope="col">hapus</th>
                </tr>
            </thead>
            <thead class="table-group-devider">
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->nama_produk }}</td>
                    <td>{{ $product->deskripsi }}</td>
                    <td>{{ $product->harga }}</td>
                    <td>{{ $product->jumlah }}</td>
                    <td>{{ $product->id_category }}</td>
                    <td><img class="admin-product-size" src="/images/produk/{{ $product->gambar }}" alt="{{ $product->gambar }}"></td>
                    <td><a href="{{ route('edit-product', $product->id_produk) }}">Ubah</a></td>
                    <td>
                        <form action="{{ route('delete-product', $product->id_produk) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </thead>
        </table>
    </div>
    <p>Tambah Produk</p>
    <form action="{{ route('add-product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="div_design">
            <label for="title">Nama Produk</label>
            <input class="text_color" required type="text" name="inProductName" placeholder="Write a title">
        </div>
        <div class="div_design">
            <label for="description">Deskripsi Produk</label>
            <input class="text_color" required type="text" name="inDeskripsi" placeholder="Write a description">
        </div>
        <div class="div_design">
            <label for="price">Harga Produk</label>
            <input class="text_color" required type="number" name="inHarga" placeholder="Write a price">
        </div>
        <div class="div_design">
            <label for="quantity">Jumlah Produk</label>
            <input class="text_color" required type="number" name="inJumlah" placeholder="Write a quantity">
        </div>
        <div class="div_design">
            <label for="category">Kategori Produk</label>
            <select class="text_color" required="" name="inCategoryName" id="">
                <option value="" selected="">Add category here</option>
                @foreach ($categories as $category)
                 <option value="{{ $category->id_category }}">{{ $category->nama_category }}</option>   
                @endforeach
            </select>
        </div>
        <div class="div_design">
            <label for="image">Gambar Produk</label>
            <input type="file" name="inGambar">
        </div>
        <div class="div_design">
            <input type="submit" value="Tambahkan Produk" class="btn btn-primary">
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