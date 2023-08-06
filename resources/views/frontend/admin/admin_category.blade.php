<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Kategori</title>
</head>
<body>    
    <a href="{{ url('/admin') }}">ByMe</a>
    <p>Halaman tambah kategori</p>
    <br>
    <form action="{{ route('add-category') }}" method="POST">
        @csrf
        <input class="input_color" type="text" name="inCategoryName" placeholder="Tuliskan Nama Kategori">
        <input type="submit" name="submit" value="Tambahkan kategori" class="btn btn-primary" placeholder="Tuliskan Nama Kategori">
        
    </form>
    <table class="center">
        <tr>
            <td>Nama kategori</td>
            <td>Aksi</td>
        </tr>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->nama_category }}</td>
            <td><a onclick="return confirm('Apakah kamu yakin ingin menghapus kategori ini?')" class="btn btn-danger" href="{{ route('update-category', $category->id_category) }}">Hapus</a></td>
        </tr>
        @endforeach
    </table>
    
    
</body>
</html>