@extends('components.layouts.member.app')

@section('title', 'Selesaikan Pemabayaran Anda')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/payment.css') }}">
@endpush

@section('content')
    <section class="payment py-5 pb-5 mt-5">
        <div class="container">
            <h2 class="text-center mb-3 fw-bold">Riwayat Pemebelian Anda</h2>
            <p class="text-center description">Anda Dapat Melihat Detail Pembelian di Sini</p>
            <div class="row justify-content-center">
                <div class="col-md-6 mt-3">
                    <div class="card card-bayar shadow p-4">
                        <h2 class="text-rinci mb-4">Riwayat Pembelian</h2>
                        <div class="nota">
                            <div class="produk mb-3">
                                <p class="mb-1">Produk yang Dibeli</p>
                                {{ $transaction->course->name }}
                            </div>
                            <div class="harga">
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Harga Kelas</p>
                                    <p class="price mb-1 fw-bold">Rp. {{ number_format($transaction->price, 0) }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="item mb-1 fw-bold">Biaya Service Tambahan</p>
                                <p class="tax mb-1 fw-bold">+ Rp. {{ $transaction->course->price ? '0' : '5.000' }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="item mb-1 fw-bold">Potongan Kode Promo</p>
                                <p class="diskon-total mb-1 fw-bold">Rp.
                                    {{ $transaction->code_discount == '' ? 'Tidak Ada' : number_format($details->promo, 0) }}
                                </p>
                            </div>

                            <div class="total d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold fs-4">Total Harga</h6>
                                <p class="fw-bold fs-4">Rp. {{ number_format($transaction->price, 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('addon-script')
    <script src="{{ asset('devacademy/member/js/claim_diskon.js') }}"></script>
@endpush
