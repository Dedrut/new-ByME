@extends('frontend.index')
@section('title', 'ByMe Keranjang')

@section('konten')
<div class="container-fluid">
    <div class="row row-cols-2 justify-content-center mt-2">
        <div class="col-7">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalHarga = 0; ?>
                        <?php $counter = 1; $ongkir = 0; ?>
                        @foreach($cartList as $cartItem)
                            <?php $hargaPerProduk = $cartItem->product->harga * $cartItem->quantity; ?>
                            <?php $totalHarga += $hargaPerProduk; ?>
                            <?php $ongkir *= $counter; ?>
                            <tr>
                                <th scope="row">{{ $counter }}</th>
                                <td><img class="img-center" height="100" src="/images/produk/{{ $cartItem->product->gambar }}" alt="{{ $cartItem->product->gambar }}"></td>
                                <td>{{ $cartItem->product->nama_produk }}</td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>{{ $hargaPerProduk }}</td>
                                <td>
                                    <a href="{{ route('remove-item', ['id_cart' => $cartItem->id_cart]) }}" class="btn p-0">
                                        <i class="fa-solid fa-square-xmark text-danger fs-5"></i>
                                    </a>
                                </td>                                
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if ($cartList->isEmpty())
                &nbsp;
            @else
            <div class="float-end">
                <dl class="row mt-4 mb-0">
                    <dt class="col-auto fw-normal">Subtotal</dt>
                    <dd class="col-auto fw-medium text-end">Rp{{number_format($totalHarga)}}</dd>
                </dl>
                <dl class="row my-0">
                    <dt class="col-auto fw-normal">Ongkir</dt>
                    <dd class="col fw-medium text-end" id="ongkirValue">Rp{{$ongkir}}</dd>
                </dl>
                <hr class="my-2">
                <dl class="row my-0">
                    <dt class="col-auto fw-bold">Total</dt>
                    <dd class="col fw-medium fw-bold text-end" id="totalValue">Rp{{number_format($totalHarga + $ongkir)}}</dd>
                </dl>
            </div>
            @endif
        </div>


        @if ($cartList->isEmpty())
            <div class="col-3 ms-4">
                &nbsp;
            </div>
        @else
        <div class="col-3 ms-4">
            <form action="{{ route('checkout') }}" method="POST" class="bg-km-gray p-3 rounded">
                @csrf
                <div class="fs-4 fw-medium text-byme-dark-blue">
                    Informasi Pembayaran
                </div>
                <div class=" text-km-gray-100 fw-light fs-7">*Harga sudah termasuk pajak</div>

                <div class=" text-km-gray-100 mt-3 mb-1">Metode Pembayaran</div>
                <div class="row row-cols-1 gy-3">
                    <label class="col">
                        <input type="radio" checked class="me-1 form-check-input" name="metodePembayaran" value="MANDIRI">
                        <i class="fa-regular fa-credit-card me-1"></i>
                        Virtual Account Mandiri
                    </label>
                    <label class="col">
                        <input type="radio" class="me-1 form-check-input" name="metodePembayaran" value="BJB">
                        <i class="fa-solid fa-credit-card me-1"></i>
                        Virtual Account BJB
                    </label>
                    <label class="col">
                        <input type="radio" class="me-1 form-check-input" name="metodePembayaran">
                        <i class="fa-regular fa-credit-card me-1" value="BNI"></i>
                        Virtual Account BNI
                    </label>
                    <label class="col">
                        <input type="radio" class="me-1 form-check-input" name="metodePembayaran">
                        <i class="fa-solid fa-credit-card me-1" value="BRI"></i>
                        Virtual Account BRI
                    </label>
                </div>


                <div class=" text-km-gray-100 mt-3 mb-1">Pilih Kurir</div>
                <div class="row row-cols-2 gy-3">
                    <label class="col-auto">
                        <input type="radio" checked class="me-1 form-check-input byme-ongkir" name="kurir" value="J&T" data-ongkir="8000">
                        J&T(Rp8,000)
                    </label>
                    <label class="col-auto">
                        <input type="radio" class="me-1 form-check-input byme-ongkir" name="kurir" value="JNE" data-ongkir="9000">
                        JNE(Rp9,000)
                    </label>
                    <label class="col-auto">
                        <input type="radio" class="me-1 form-check-input byme-ongkir" name="kurir" value="Sicepat" data-ongkir="11500">
                        Sicepat(Rp11,500)
                    </label>
                    <label class="col-auto">
                        <input type="radio" class="me-1 form-check-input byme-ongkir" name="kurir" value="AnterAja" data-ongkir="11500">
                        AnterAja(Rp11,500)
                    </label>
                </div>

                <div class="col-12 d-grid gap-2 mt-3 mb-4">
                    <button class="btn btn-info rounded-1 fw-medium text-white" type="submit">Check Out</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

<script>
    function calculateTotalPrice() {
        const totalHarga = parseFloat({{ $totalHarga }});
        const selectedOngkir = parseFloat($('.byme-ongkir:checked').attr('data-ongkir'));
        const total = totalHarga + selectedOngkir;
        $('#ongkirValue').text('Rp' + selectedOngkir.toLocaleString());
        $('#totalValue').text('Rp' + total.toLocaleString());
    }
    $(document).ready(function() {
        calculateTotalPrice();
        $('.byme-ongkir').on('change', calculateTotalPrice);
    });
</script>
@endsection
