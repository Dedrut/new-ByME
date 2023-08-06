<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ByMe - Admin Dashboard</title>
</head>
<body>
    <p>Admin Dashboard</p>
    <a href="{{ url('/admin') }}">ByMe</a>
    <a href="{{ route('logout') }}">Logout</a> 
    <a href="{{ route('order-page') }}">Order</a> 
    <a href="{{ route('category-page') }}">Tambah Kategori</a> 
    <a href="{{ route('product-page') }}">Halaman Produk</a> 
    {{-- <a href="{{ route('add-product') }}">Tambah Produk</a> 
    <a href="{{ route('update-product') }}">Update Produk</a>  --}}
</body>
</html>