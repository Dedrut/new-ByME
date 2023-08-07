@extends('frontend.index')
@section('title', 'ByMe HomePage')

@section('konten')
<div class="modal" tabindex="-1" id="detailProduk">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-flex flex-column">
                <div class="d-flex px-3 mt-2 mb-1 pe-0">
                    <img src="{{ asset('images/1.jpg') }}" alt="gambar" height="150" class="border border-2 border-km-gray-50">
                    <div class="fs-6 mt-1 ms-2">
                        <a href="" class="km-fw-semiBold">
                            <span class="truncate-1 fw-medium py-1">Semvak Dajjal</span>                                                                       
                        </a>
                        <span class="d-block text-km-gray-100">1 x Rp50.000</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center ms-3">
                    <div class="fs-6">
                        <span class="d-block text-km-gray-100">Total Harga</span>
                        <span class="d-block fw-medium">Rp50.000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning text-white" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



<div class="container">
    <div class="row row-cols-1 justify-content-center mt-3">
        <div class="col-12 col-lg-5">
            <div class="d-flex justify-content-between align-content-center">
                <span class="fs-4 fw-medium">Detail Pesanan</span>
                <span class="fs-5 fw-medium text-success">Sukses <i class="fa-regular fa-circle-check"></i></span>
            </div>

            <hr class="mt-1">

            <div class="d-flex justify-content-between mt-2 align-items-center">
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Tanggal Pembelian</span>
                    <span class="d-block fw-medium">26 Januari 2023, 10:00 WIB</span>
                </div>
                <a href="javascript:void(0)" class="fs-6 rounded-4 text-decoration-none" data-bs-toggle="modal" data-bs-target="#detailProduk">
                    <span class="d-block fw-medium">Detail Produk</span>
                </a>
            </div>

            <hr class="border-2 border-km-gray-100">
            
            <div class="d-flex justify-content-between mt-3 align-items-center">
                <div class="fs-6">
                    <span class="d-block fw-bold">Rincian Pembayaran</span>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-1 mx-3 align-items-center">
                <div class="fs-6">
                    <table class="byme-table">
                        <tr>
                            <td><span class="text-km-gray-100">Metode Pembayaran</span></td>
                            <td><span class="ms-5">BNI Virtual Account</span></td>
                        </tr>
                        <tr class="py-2">
                            <td><span class="text-km-gray-100">Total Harga(X barang)</span></td>
                            <td><span class="ms-5">Rp.XXXXXX</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-km-gray-100">Total Ongkos Kirim</span></td>
                            <td><span class="ms-5">Rp.XXXXXX</span></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td><span class="fw-medium">Total Harga</span></td>
                            <td><span class="ms-5 fw-medium">Rp.XXXXXX</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3 align-items-center">
                <div class="fs-6">
                    <span class="d-block fw-bold">Info Pengiriman</span>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-1 mx-3 align-items-center">
                <div class="fs-6">
                    <table>
                        <tr>
                            <td><span class="text-km-gray-100">Kurir</span></td>
                            <td><span class="ms-5">JNE Express</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-km-gray-100">No Resi</span></td>
                            <td><span class="ms-5">LK6-UVX-0016283647</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            {{--  --}}                
        </div>
    </div>
</div>
@endsection