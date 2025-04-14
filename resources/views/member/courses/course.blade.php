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

                <!-- Sidebar -->
                <div class="col-md-3 p-0">
                    <div class="col-md-9 ms-5">
                        <div class="sidebar">
                            <div class="filter-kelas">
                                <div class="filter-header d-flex gap-3 justify-content-center align-items-center">
                                    <h5 class="fw-bold d-inline">Filter Kelas</h5>
                                </div>
                                <hr>

                                <form id="filter-form" action="{{ route('member.course') }}" method="GET">
                                    <ul>
                                        <li>
                                            <input id="filter-kelas-semua" name="filter-kelas" value="semua" type="radio"
                                                {{ request('filter-kelas') == 'semua' ? 'checked' : '' }} checked>
                                            <label for="filter-kelas-semua">Semua</label>
                                        </li>

                                        @foreach ($category as $data)
                                            <li>
                                                <input id="filter-kelas-{{ Str::slug($data->name) }}" name="filter-kelas"
                                                    value="{{ $data->name }}" type="radio"
                                                    {{ request('filter-kelas') == $data->name ? 'checked' : '' }}>
                                                <label
                                                    for="filter-kelas-{{ Str::slug($data->name) }}">{{ $data->name }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-9 mt-5 mt-md-0" id="course-card">
                    <div class="card-container">
                        <div class="row" id="row">
                            @if ($courses->count() <= 0)
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <div class="not-found text-center d-flex justify-content-center align-items-center">
                                        {{-- <img src="{{ asset('devacademy\member\img\search-not-found.png') }}"
                                            class="logo-not-found w-50 h-50" alt="Not Found"> --}}
                                        <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                    </div>
                                </div>
                            @else
                                @foreach ($courses as $course)
                                    <div class="col-md-4 col-12 d-flex justify-content-center my-1 pb-3">
                                        <div class="card d-block flex-row">
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}"
                                                class="card-img-top d-block" alt="hero course" />
                                            <div class="card-body">
                                                <div class="title-card">
                                                    <h5 class="fw-bold truncate-text">{{ $course->category }}: <br>
                                                        {{ $course->name }}</h5>
                                                </div>
                                                <div class="btn-group-harga d-flex justify-content-between mt-md-3">
                                                    {{-- <div class="avatar m-0 fw-bold me-1"> --}}
                                                    <div class="profile">
                                                        @if ($course->users->avatar == 'default.png')
                                                            <img class="me-2"
                                                                src="{{ asset('devacademy/member/img/default.png') }}"
                                                                alt="img user {{ $course->users->name }}" />
                                                        @else
                                                            <img class="me-2"
                                                                src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                                                                alt="img user {{ $course->users->name }}" />
                                                        @endif
                                                        {{ $course->users->name }}
                                                    </div>
                                                    <div
                                                        class="btn-group-harga d-flex justify-content-between align-items-center">
                                                        <div class="harga">
                                                            <div class="d-flex sertifikat">
                                                                <img class="me-2 icon-serti" id="check-icon"
                                                                    src="{{ asset('devacademy/member/img/icon/check-serti.svg') }}"
                                                                    alt="" />
                                                                <p class="p-0 m-0 fw-semibold">Sertifikat</p>
                                                            </div>
                                                            <p class="p-0 m-0 mt-2 price fw-semibold float-end">
                                                                Rp. {{ number_format($course->price, 0) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                                </div>
                                                <a href="{{ route('member.course.join', $course->slug) }}"
                                                    class="btn btn-primary py-2 mt-3">Mulai Belajar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('addon-script')
    <script src="{{ asset('devacademy/member/js/sidebar-course.js') }}"></script>
    <script src="{{ asset('devacademy/member/js/course.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filter-form');
            const radios = form.querySelectorAll('input[name="filter-kelas"]');
            const courseList = document.getElementById('course-list'); // ID div daftar course

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (courseList) {
                        courseList.innerHTML =
                            '<p>Memuat ulang data...</p>'; // Kosongkan sebelum reload
                    }
                    form.submit(); // Lanjutkan submit seperti biasa
                });
            });

            // Auto submit default "semua"
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('filter-kelas')) {
                const defaultRadio = document.getElementById('filter-kelas-semua');
                if (defaultRadio) {
                    defaultRadio.checked = true;
                    form.submit();
                }
            }
        });
    </script>
@endpush
