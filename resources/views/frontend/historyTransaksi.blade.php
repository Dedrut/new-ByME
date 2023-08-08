@extends('Frontend.index')
@section('title', 'ByMe Transaksi')
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
                
            $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
            return $result;
    }
@endphp


<div class="container my-5">
  <div class="row row-cols-2 justify-content-center">
    <div class="col-6">
        @foreach ($orders as $order)
        @php
            $date = new DateTime($order->created_at);
            $date->setTimezone(new DateTimeZone("Asia/Jakarta"));
            $formattedDate = $date->format('Y-m-d\TH:i:s\Z');
        @endphp
            <a href="{{ route('pembayaran', $order->external_id) }}" class="d-flex justify-content-between align-items-center text-bg-km-gray-10 my-4 p-2">
                <div class="d-flex flex-column text-black">
                    <span class="fs-5 fw-medium">{{ tgl_indonesia($formattedDate) }}</span>
                    @if ($order->status_order === 'PENDING')
                        <span class="text-primary">{{ $order->kurir }}, {{ $order->metode_pembayaran }}</span>
                    @else
                        <span class="text-primary">No Resi: {{ $order->no_resi }}</span>
                    @endif
                </div>
                <div class="">
                    @if ($order->status_order === 'PENDING')
                    <span class="text-warning">
                        {{ $order->status_order }} 
                        <span class="ms-1 me-2"><i class="fa-solid fa-bolt"></i></span>
                    </span>
                    @else
                    <span class="text-success">
                        {{ $order->status_order }} 
                        <span class="ms-1 me-2"><i class="fa-solid fa-check"></i></span>
                    </span>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
  </div>
</div>
@endsection

