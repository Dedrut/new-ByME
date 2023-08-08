@extends('Backend.index')
@section('titleHalaman', 'Admin - Kategori')
@section('Kategori', 'active')

@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('modalTambah')
<form method="POST" action="{{ route('add-product') }}" enctype="multipart/form-data">
@csrf
<div class="modal fade km-ff-asap" id="modalTambahManga" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Tambah Data Produk</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="inProductName" class="form-label">Nama Kategori</label>
                <div class="input-group">
                    <input type="text" placeholder="Masukkan Nama Produk" class="form-control" name="inProductName" id="inProductName" required>
                </div>
            </div>       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
          <button type="reset" class="btn btn-info text-white">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('modalEdit')
<form method="POST" action="{{ route('update-product') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="idProduk" id="idProduk" hidden>
    <div class="modal fade" id="modalEditManga" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Edit Data Produk</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editProductName" class="form-label">Nama Produk</label>
                    <div class="input-group">
                        <input type="text" placeholder="Masukkan Nama Produk" class="form-control" name="editProductName" id="editProductName" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editDeskripsi" class="form-label">Deskripsi</label>
                    <div class="input-group">
                        <textarea placeholder="Masukkan Deskripsi" class="form-control" name="editDeskripsi" id="editDeskripsi" required></textarea>
                    </div>              
                </div>
                <div class="mb-3">
                    <label for="editGambar" class="form-label">Gambar Produk</label>
                    <div class="input-group">
                        <input type="file" placeholder="Masukkan Gambar Produk" class="form-control" name="editGambar" id="editGambar">
                    </div>                
                </div>
                <div class="mb-3">
                    <label for="editCategoryName" class="form-label">Kategori</label>
                    <div class="input-group">
                        <select name="editCategoryName" id="editCategoryName" class="form-select" required>
                            @foreach ($category as $item)
                                <option value="{{ $item->id_category }}">{{ $item->nama_category }}</option>
                            @endforeach    
                        </select>
                    </div>                                       
                </div>
                <div class="mb-3">
                    <label for="editJumlah" class="form-label">Jumlah Produk</label>
                    <div class="input-group">
                        <input type="number" placeholder="Masukkan Jumlah Produk" class="form-control" name="editJumlah" id="editJumlah" required>
                    </div>                                
                </div>
                <div class="mb-3">
                    <label for="editHarga" class="form-label">Harga Produk</label>
                    <div class="input-group">
                        <input type="number" placeholder="Masukkan Harga Produk" class="form-control" name="editHarga" id="editHarga" required>
                    </div>                                
                </div>                  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>              
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
@endsection

@section('konten')
<script type="text/javascript">
	function update(id){
		//alert(id);
		//window.location.href = "{{url('admin/viewMasyarakat/json')}}/"+id;

		$.ajax({
			type: "GET",
			url: "{{ url('/admin/product') }}/" + id,
			success: function(result){
				$('#idProduk').val(id);
				$('#editCategoryName').val(result.id_category);
				$('#editProductName').val(result.nama_produk);
				$('#editDeskripsi').val(result.deskripsi);
				$('#editJumlah').val(result.jumlah);
				$('#editHarga').val(result.harga);

				$('#modalUpdate').modal('show');
			}
		});
	}

	function deleteSwal(id){
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					).then((result)=>{
						if (result.value) {
						window.location.replace("{{url('/admin/product/delete')}}/"+id);
					}
				})
			}
		})
	}
</script>



<div class="page-content km-ff-asap" id="km-content">
    <button type="button" class="" style="border-radius: 0;" id="sidebarCollapse"></button>
    <div class="px-5 ms-5 pt-5 pb-5">
        <div class="container-fluid p-0 shadow">
            <div class="d-flex justify-content-between align-items-center bg-km-gray p-3">
                <h5 class="text-primary m-0">
                    <i class="fa-solid fa-list me-3"></i>
                    Data Produk
                </h5>
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambahManga">
                    <i class="fa-solid fa-circle-plus"></i>
                    Tambah data
                </button>
            </div>
            <div class="bg-white p-3">
                <div class="table-responsive">
                    <table class="table table-bordered border-gray mt-3" id="km-table">
                        <thead>
                            <tr>
                                <th>@php echo("No."); $no = 1;@endphp</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($products as $item)
                            <tr>
                                <th>@php echo $no; $no++;@endphp</th>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td><img class="object-fit-cover" src="/images/produk/{{ $item->gambar }}" alt="{{ $item->gambar }}" height="150"></td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->id_category }}</td>
                                <td class="fs-5">                   
                                    <button type="button" class="editBtn" onclick="update({{ $item->id_produk }})" data-bs-toggle="modal" data-bs-target="#modalEditManga"><i class="fa-solid fa-pen-to-square text-secondary mx-1"></i></button>
                                    <button type="button" class="deleteBtn" onclick="deleteSwal({{ $item->id_produk }})"><i class="fa-solid fa-trash-can text-danger"></i></button>   
                                    <div class="px-5"></div>                        
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection