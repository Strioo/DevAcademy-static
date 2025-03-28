@extends('components.layouts.member.app')

@section('title', 'Pilih Kursus Yang Ingin Anda Pelajari')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/components/member/css/sidebar-filter.css') }} ">
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/course.css') }} ">
@endpush

@section('content')
    <section class="section-pilh-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                <div class="mobile-filter col-12 mb-5 d-lg-none fixed-top py-2">
                    <div class="filter-menu d-flex align-items-center gap-2">
                        <button class="filter-togle btn btn-warning">
                            <img src="{{ asset('devacademy/components/member/img/filter.png') }}" alt="">
                        </button>
                        <form action="{{ route('member.course') }}" method="GET" class="d-flex flex-grow-1">
                            <div class="search position-relative w-100">
                                <input type="text" name="search-input" class="searchTerm form-control"
                                    placeholder="Cari Kelas Disini" id="search-input" value="{{ request('search-input') }}">
                                <button type="submit" class="searchButton position-absolute">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @include('components.includes.member.sidebar-filter')
                <div class="col-md-9 mt-5 mt-md-0" id="course-card">
                    <div class="card-container">
                        <div class="row" id="row">
                            {{-- <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('devacademy\member\img\search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div> --}}
                            <div class="col-md-4 col-12 d-flex justify-content-center my-1 pb-3">
                                <div class="card d-block flex-row">
                                    <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" class="card-img-top  d-block"
                                    alt="" />
                                    <div class="card-body">
                                        <div class="title-card">
                                            <h5 class="fw-bold truncate-text">Frontend Developer sadabsdadadgfhjhnmsaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h5>
                                        </div>
                                        <div class="btn-group-harga d-flex justify-content-between mt-md-3">
                                            {{-- <div class="avatar m-0 fw-bold me-1"> --}}
                                                <div class="profile">
                                                    <img class="me-2" src="{{ asset('devacademy/member/img/icon/Group 7.png') }}" alt="" />
                                                    Wahid
                                                </div>
                                                <div class="btn-group-harga d-flex justify-content-between align-items-center">
                                                    <div class="harga">
                                                        <div class="d-flex sertifikat">
                                                            <img class="me-2 icon-serti" id="check-icon"
                                                            src="{{ asset('devacademy/member/img/icon/check-serti.svg') }}"
                                                            alt="" />
                                                            <p class="p-0 m-0 fw-semibold">Sertifikat</p>
                                                        </div>
                                                        <p class="p-0 m-0 mt-2 price fw-semibold float-end">
                                                            {{-- @php
                                                                $currentBundling = $bundling[$course->id] ?? null;
                                                            @endphp
                                                            {{ $currentBundling
                                                                ? ($currentBundling->price == 0
                                                                    ? 'Gratis'
                                                                    : 'Rp' . number_format($currentBundling->price, 0, ',', '.'))
                                                                : ($course->price == 0
                                                                    ? 'Gratis'
                                                                    : 'Rp' . number_format($course->price, 0, ',', '.')) }} --}}
                                                                    Gratis
                                                        </p>
                                                    </div>
                                                </div>
                                            {{-- </div> --}}
                                        </div>
                                        <a href="" class="btn btn-primary py-2 mt-3">Mulai Belajar</a>
                                    </div>
                                </div>
                            </div>
                            @include('components.includes.member.partials.course-card')
                            @include('components.includes.member.partials.course-card')
                            @include('components.includes.member.partials.course-card')
                            @include('components.includes.member.partials.course-card')
                            @include('components.includes.member.partials.course-card')
                            @include('components.includes.member.partials.course-card')
                        </div>                
                            {{-- <h1>{{ $data->count() }}</h1> --}}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('addon-script')
    <script src="{{ asset('devacademy/member/js/scroll-dashboard.js') }}"></script>
    <script>
        document.querySelector('.filter-togle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const body = document.body;

            sidebar.classList.toggle('show-sidebar');
            body.classList.toggle('no-scroll');
        });

        // Menutup sidebar saat mencapai footer
        window.addEventListener('scroll', function() {
            const sidebar = document.querySelector('.sidebar');
            const footer = document.querySelector('#footer');
            const body = document.body;

            const footerTop = footer.getBoundingClientRect().top;
            const sidebarBottom = sidebar.getBoundingClientRect().bottom;
            if (sidebarBottom >= footerTop) {
                sidebar.classList.remove('show-sidebar');
                body.classList.remove('no-scroll');
            }
        });

        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleButton = document.querySelector('.filter-togle');
            const body = document.body;

            if (sidebar.classList.contains('show-sidebar') &&
                !sidebar.contains(event.target) &&
                !toggleButton.contains(event.target)) {
                sidebar.classList.remove('show-sidebar');
                body.classList.remove('no-scroll');
            }
        });
    </script>
@endpush
