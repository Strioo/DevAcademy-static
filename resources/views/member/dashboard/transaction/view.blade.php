@extends('components.layouts.member.dashboard')

@section('title', 'Devacademy - Lihat informasi dan perkembangan anda disini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/dashboard-css/transaction.css') }} ">
@endpush
@section('content')
    <section class="section-pilih-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                @include('components.includes.member.sidebar-dashboard')
                <div class="col-12 col-lg-9">
                    <div>
                        <h3 class="fw-bold">Transaksi Saya</h3>
                    </div>
                    <!-- Navigation Tabs -->
                    <div class="filter-transaction">
                        <ul class="nav-tabs mt-2">
                            <li><a href="{{ route('member.transaction', ['status' => null]) }}"
                                    class="{{ is_null($status) ? 'active' : '' }}">Semua</a></li>
                            <li><a href="{{ route('member.transaction', ['status' => 'success']) }}"
                                    class="{{ $status === 'success' ? 'active' : '' }}">Berhasil</a></li>
                            <li><a href="{{ route('member.transaction', ['status' => 'pending']) }}"
                                    class="{{ $status === 'pending' ? 'active' : '' }}">Pending</a></li>
                            {{-- <li><a href="{{ route('member.transaction', ['status' => 'refund']) }}"
                                class="{{ $status === 'refund' ? 'active' : '' }}">Refund</a></li> --}}
                            <li><a href="{{ route('member.transaction', ['status' => 'failed']) }}"
                                    class="{{ $status === 'failed' ? 'active' : '' }}">Gagal</a></li>
                        </ul>
                    </div>
                    @if ($transactions->isEmpty())
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div class="not-found text-center">
                                <p class="mt-3">Tidak Ada Transaksi</p>
                            </div>
                        </div>
                    @endif
                    <!-- Transaction Cards -->
                    @foreach ($transactions as $transaction)
                        <div class="card mt-3">
                            <div class="card-body d-flex align-items-center">

                                <img alt="Product image"
                                    src="{{ asset('storage/images/covers/' . $transaction->course->cover) }}"
                                    height="90" width="130" class="cover me-3" />
                                <div class="details">
                                    <h5 class="title">{{ $transaction->name }}</h5>
                                    @if ($transaction->price == 0)
                                        <p class="Premium">
                                            Kelas Gratis
                                        </p>
                                    @else
                                        <p class="Premium">
                                            Kelas Premium
                                        </p>
                                    @endif
                                    <div class="info mt-3">
                                        @if ($transaction->price != 0)
                                            <p class="price pe-2"><span class="text-black">Harga :
                                                </span>Rp{{ number_format($transaction->price, 0, ',', '.') }}</p>
                                        @else
                                            <p class="price pe-2"><span class="text-black">Harga : </span>Gratis</p>
                                        @endif

                                        <p class="date text-black fw-normal pe-2">Tanggal:
                                            {{ $transaction->created_at->format('d-M-Y') }}</p>
                                        <p class="status text-black fw-normal">Status:</p>
                                        <p class="status-info fw-normal"
                                            style="color: {{ $transaction->status === 'success' ? '#4CAF50' : ($transaction->status === 'pending' ? 'orange' : 'red') }};">
                                            {{ ucfirst($transaction->status) }}
                                        </p>
                                    </div>
                                    <div class="aksi d-flex mt-1 justify-content-end d-md-none">
                                        @if ($transaction->status === 'pending')
                                            <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                class="d-flex gap-2" method="POST"
                                                onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Batalkan
                                                    Pembelian</button>
                                                <a href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"
                                                    class="btn btn-primary">Bayar</a>
                                            </form>
                                        @elseif ($transaction->status === 'failed')
                                            <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus
                                                    Transaksi</button>
                                            </form>
                                        @else
                                            <a href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"
                                                class="btn btn-primary">Cek Tagihan</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="action d-none d-md-block">
                                    @if ($transaction->status === 'pending')
                                        <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                            class="d-flex gap-2" method="POST"
                                            onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Batalkan Pembelian</button>
                                            <a href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"
                                                class="btn btn-primary">Bayar</a>
                                        </form>
                                    @elseif ($transaction->status === 'failed')
                                        <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus Transaksi</button>
                                        </form>
                                    @else
                                        <a href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"
                                            class="btn btn-primary ">Cek
                                            Tagihan</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <!-- Button for Load More -->
                    {{-- <div class="btn-more mt-lg-5 d-flex justify-content-center">
                    <button class="btn btn-primary d-inline-flex align-items-center">
                        Tampilkan Lebih Banyak
                        <span class="d-flex align-items-center">
                            <box-icon name='chevron-down' color="#414142"></box-icon>
                        </span>
                    </button>
                </div> --}}
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
    <script src="{{ asset('devacademy/member/js/scroll-dashboard.js') }}"></script>
@endpush
