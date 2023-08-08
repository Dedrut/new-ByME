@extends('frontend.index')
@section('title', 'ByMe HomePage')

@section('konten')

@php
     function tgl_indonesia($date){
            /* ARRAY u/ hari dan bulan */
            $Hari = array ("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",);
            $Bulan = array ("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            
            /* Memisahkan format tanggal bulan dan tahun menggunakan substring */
            $tahun 	 = substr($date, 0, 4);
            $bulan 	 = substr($date, 5, 2);
            $tgl	 = substr($date, 8, 2);
            $waktu	 = substr($date,11, 5);
            $hari	 = date("w", strtotime($date));
                
            $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu." WIB";
            return $result;
        }


     if ($order->status_order == 'PENDING') {
         $expiredDate = new DateTime($virtualAcc['expiration_date']);
         $expiredDate->setTimezone(new DateTimeZone("Asia/Jakarta"));
         $formattedExpiredDateTime = $expiredDate->format('Y-m-d\TH:i:s\Z');

     } else {
         $transactionDate = new DateTime($virtualAcc['transaction_timestamp']);
         $transactionDate->setTimezone(new DateTimeZone("Asia/Jakarta"));
         $formattedTransactionDateTime = $transactionDate->format('Y-m-d\TH:i:s\Z');
     }
 @endphp

@php
// Import the Carbon class
use Carbon\Carbon;

// Set the timezone to Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');

// Get the current date and time in Indonesia timezone
$now = Carbon::now();
@endphp



<div class="modal" tabindex="-1" id="detailProduk">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @php
                $total = 0;
            @endphp
            @foreach ($listItem as $item)
                <div class="d-flex flex-column mb-4">
                    <div class="d-flex px-3 mb-1 pe-0">
                        <img src="{{ asset('images/1.jpg') }}" alt="gambar" height="150" class="border border-2 border-km-gray-50">
                        <div class="fs-6 mt-1 ms-2">
                            <a href="" class="km-fw-semiBold">
                                <span class="truncate-1 fw-medium py-1">{{$item->product->nama_produk}}</span>                                                                       
                            </a>
                            <span class="d-block text-km-gray-100">{{$item->quantity}} x Rp{{number_format($item->product->harga)}}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center ms-3">
                        <div class="fs-6">
                            <span class="d-block text-km-gray-100">Total Harga</span>
                            <span class="d-block fw-medium">Rp{{number_format($item->product->harga * $item->quantity)}}</span>
                        </div>
                    </div>
                </div>
                @php
                    $total += $item->product->harga * $item->quantity;
                @endphp
            @endforeach
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
                @if ($order->status_order === 'PENDING')
                    <div class="fs-5 fw-medium text-danger">
                        <span id="countdown" class=""></span>
                        <i class="fa-solid fa-stopwatch"></i>
                    </div>
                @else
                    <span class="fs-5 fw-medium text-success">Sukses <i class="fa-regular fa-circle-check"></i></span>
                @endif
            </div>

            <hr class="mt-1">

            <div class="d-flex justify-content-between mt-2 align-items-center">
                @if ($order->status_order === 'PENDING')
                    <div class="fs-6">
                        <span class="d-block text-km-gray-100">Batas pembayaran</span>
                        <span class="d-block fw-medium">{{tgl_indonesia($formattedExpiredDateTime)}}</span>
                    </div>
                @else
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Tanggal Pembelian</span>
                    <span class="d-block fw-medium">{{tgl_indonesia($formattedTransactionDateTime)}}</span>
                </div>
                @endif
                
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
                            <td><span class="ms-5">Virtual Account {{ $virtualAcc['bank_code'] }}</span></td>
                        </tr>
                        <tr class="py-2">
                            <td><span class="text-km-gray-100">Total Harga({{$listItem->sum('quantity')}} barang)</span></td>
                            <td><span class="ms-5">Rp.{{number_format($total)}}</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-km-gray-100">Total Ongkos Kirim</span></td>
                            @php
                                $ongkir = 0;
                                switch ($order->kurir) {
                                    case 'JNE':
                                        $ongkir = 9000;
                                        break;

                                    case 'J&T':
                                        $ongkir = 8000;
                                        break;

                                    case 'Sicepat':
                                        $ongkir = 11500;
                                        break;

                                    case 'AnterAja':
                                        $ongkir = 11500;
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                            @endphp
                            <td><span class="ms-5">Rp.{{number_format($ongkir)}}</span></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td><span class="fw-medium">Total Harga</span></td>
                            <td><span class="ms-5 fw-medium">Rp.{{number_format($ongkir + $total)}}</span></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td><span class="fw-medium">Status pembayaran</span></td>
                            <td><span class="ms-5 fw-medium @if ($order->status_order == 'PENDING') text-warning @else text-success @endif">{{$order->status_order}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            @if ($order->status_order === 'PENDING')
                &nbsp;
            @else
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
                            <td><span class="ms-5">{{$order->kurir}}</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-km-gray-100">No Resi</span></td>
                            <td><span class="ms-5">{{$order->no_resi}}</span></td>
                        </tr>
                        @if ($order->status_order === 'SUKSES')
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <td><span class="text-km-gray-100">Status Pengiriman</span></td>
                            <td><span class="ms-5 fw-medium">{{$order->status_pengiriman}}</span></td>
                        @endif
                    </table>
                </div>
            </div>
            @endif
            {{--  --}}                
        </div>
    </div>
</div>




@if ($order->status_order == 'PENDING')
    <script>
        function updateCountdown() {
            var currentDate = new Date();

            var specifiedDate = new Date("{{$virtualAcc['expiration_date']}}");

            var timeDiff = specifiedDate.getTime() - currentDate.getTime();

            if (timeDiff <= 0) {
                console.log("Pembayaran Kadaluwarsa");
                return;
            }

            var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            $("#countdown").text(hours + " : " + minutes + " : " + seconds);
        }
        $(document).ready(function() {
            setInterval(updateCountdown, 1000);
        });
    </script>
@endif

@endsection