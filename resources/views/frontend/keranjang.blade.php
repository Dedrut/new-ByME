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
                        <th>Text 1</th>
                        <th>Text 2</th>
                        <th>Text 3</th>
                        <th>Text 4</th>
                        <th>Text 5</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Lorem</td>
                        <td>Ipsum</td>
                        <td>Dolor</td>
                        <td>Sit</td>
                        <td>Amet</td>
                        <td>Syntesis</td>
                        <td>
                            <a href="#" class="btn p-0">
                                <i class="fa-solid fa-square-xmark text-danger fs-5"></i>
                            </a>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <div class="float-end">
                <dl class="row mt-4 mb-0">
                    <dt class="col-auto fw-normal">Subtotal</dt>
                    <dd class="col-auto fw-medium text-end">Rp.00000000</dd>
                </dl>
                <dl class="row my-0">
                    <dt class="col-auto fw-normal">Ongkir</dt>
                    <dd class="col fw-medium text-end">Rp.00000000</dd>
                </dl>
                <hr class="my-2">
                <dl class="row my-0">
                    <dt class="col-auto fw-bold">Total</dt>
                    <dd class="col fw-medium fw-bold text-end">Rp.00000000</dd>
                </dl>
            </div>
        </div>
        <div class="col-3 ms-4">
            <form action="#" method="POST" class="bg-km-gray p-3 rounded">
                <div class="fs-4 fw-medium text-byme-dark-blue">
                    Informasi Pembayaran
                </div>
                <div class=" text-km-gray-100 fw-light fs-7">*Harga sudah termasuk pajak</div>

                <div class=" text-km-gray-100 mt-3 mb-1">Metode Pembayaran</div>
                <div class="row row-cols-1 gy-3">
                    <label class="col">
                        <input type="radio" checked class="me-1 form-check-input" name="metodePembayaran" value="Mandiri">
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

                <div class="col-12 d-grid gap-2 mt-3 mb-4">
                    <button class="btn btn-info rounded-1 fw-medium text-white" type="submit">Check Out</button>                            
                </div>
            </form>
        </div>
    </div>
</div>
@endsection