@extends('components.layouts.member.dashboard')

@section('title', 'Devacademt - Lihat informasi dan perkembangan anda disini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/dashboard-css/mycourse.css') }} ">
@endpush
@section('content')

    <section class="section-pilh-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5 mb-5">
            <div class="row">
                @include('components.includes.member.sidebar-dashboard')
                <!-- Cards -->
                <div class="card-container col-md-9 pe-4" id="course-card">
                    <div>
                        <h3 class="fw-bold">Kelas Saya</h3>
                    </div>
                    {{-- <div class="filter-transaction mb-3">
                        <ul class="nav-tabs">
                            <li><a href="{{ route('member.dashboard', ['filter' => 'semua']) }}" class="{{ request('filter') == 'semua' || !request('filter') ? 'active' : '' }}">Semua</a></li>
                            <li><a href="{{ route('member.dashboard', ['filter' => 'kursus']) }}" class="{{ request('filter') == 'kursus' ? 'active' : '' }}">Kursus</a></li>
                            <li><a href="{{ route('member.dashboard', ['filter' => 'ebook']) }}" class="{{ request('filter') == 'ebook' ? 'active' : '' }}">E-Book</a></li>
                        </ul>
                    </div>                                   --}}
                    <div class="row mt-4">
                        @if ($coursesProgress->isEmpty() && $ebooks->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('devacademy/member/img/search-not-found.png') }}"
                                        class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach ($coursesProgress as $course)
                            @if ($course->transactions->isNotEmpty())
                                <a href="{{ route('member.course.join', $course->slug) }}"
                                    class="col-md-4 d-flex justify-content-center pb-3 my-2 text-decoration-none">
                                    <div class="card">
                                        @if ($course->cover != null)
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}"
                                                class="card-img-top" alt="...">
                                        @else
                                            <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" class="card-img-top"
                                                alt="...">
                                        @endif
                                        <div class="card-body">
                                            {{-- <div>
                                        @if ($course->cover != null)
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}" alt="..." style="height: 40px;width: 60px; border-radius: 5px;" class="d-block d-md-none">
                                        @else
                                            <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" alt="..." style="height: 40px;width: 60px; border-radius: 5px;" class="d-block d-md-none">
                                        @endif
                                        </div> --}}
                                            <div>
                                                <div class="title-card">
                                                    <h5 class="fw-bold truncate-text" style="">{{ $course->name }}
                                                    </h5>
                                                </div>
                                                <div class="btn-group-harga d-flex justify-content-between mt-md-3">
                                                    {{-- <div class="avatar m-0 fw-bold me-1"> --}}
                                                    <div class="profile mb-0">
                                                        @if ($course->users->avatar != null)
                                                            <img class="me-2"
                                                                src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                                                                alt="" />
                                                        @else
                                                            <img class="me-2"
                                                                src="{{ asset('devacademy/member/img/icon/Group 7.png') }}"
                                                                alt="" />
                                                        @endif
                                                        {{ $course->users->name }}
                                                        <p class="tipe mb-0 mt-2">Kelas {{ $course->type }}</p>
                                                    </div>
                                                    <div class="btn-group-harga d-flex">
                                                        <div class="harga">
                                                            <div class="d-flex sertifikat">
                                                                <img class="me-2 icon-serti" id="check-icon"
                                                                    src="{{ asset('devacademy/member/img/icon/check-serti.svg') }}"
                                                                    alt="" />
                                                                <p class="p-0 m-0 fw-semibold">Sertifikat</p>
                                                            </div>
                                                            <p class="p-0 m-0 mt-2 price fw-semibold float-end">
                                                                @php
                                                                    $currentBundling = $bundling[$course->id] ?? null;
                                                                @endphp
                                                                {{ $currentBundling
                                                                    ? ($currentBundling->price == 0
                                                                        ? 'Gratis'
                                                                        : 'Rp' . number_format($currentBundling->price, 0, ',', '.'))
                                                                    : ($course->price == 0
                                                                        ? 'Gratis'
                                                                        : 'Rp' . number_format($course->price, 0, ',', '.')) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                                </div>
                                                <div
                                                    class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3 gap-1 gap-md-0">
                                                    <div class="harga d-block">
                                                        <p class="p-0 m-0 ">Status: <br class="d-none d-md-block"><span
                                                                style="color: #666666">{{ $course->status }}</span></p>
                                                    </div>
                                                    <div class="harga d-block">
                                                        <p class="p-0 m-0">Bergabung: <br class="d-none d-md-block"> <span
                                                                style="color: #666666">{{ $course->created_at->format('d F Y') }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach


                        {{-- @foreach ($ebooks as $ebook)
                            @if ($ebook->transactions->isNotEmpty())
                                <a href="{{ route('member.ebook.join', $ebook->slug) }}"
                                    class="col-md-4 d-flex justify-content-center my-2 pb-3 text-decoration-none">
                                    <div class="card">
                                        @if ($ebook->cover != null)
                                            <img src="{{ asset('storage/images/covers/' . $ebook->cover) }}"
                                                class="card-img-top d-none d-md-block" alt="...">
                                        @else
                                            <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}"
                                                class="card-img-top d-none d-md-block" alt="...">
                                        @endif
                                        <div class="card-body">
                                            <div>
                                                @if ($ebook->cover != null)
                                                    <img src="{{ asset('storage/images/covers/' . $ebook->cover) }}"
                                                        alt="..." style="height: 40px;width: 60px; border-radius: 5px;"
                                                        class="d-block d-md-none">
                                                @else
                                                    <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}"
                                                        alt="..." style="height: 40px;width: 60px; border-radius: 5px;"
                                                        class="d-block d-md-none">
                                                @endif
                                            </div>
                                            <div>
                                                <div class="title-card">
                                                    <p class="fw-bold truncate-text">{{ $ebook->name }}</p>
                                                    <p class="tipe">E-Book {{ $ebook->type }}</p>
                                                </div>
                                                <div
                                                    class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3 gap-1 gap-md-0">
                                                    <div class="harga d-block">
                                                        <p class="p-0 m-0 fw-bold">Bergabung : <br
                                                                class="d-none d-md-block"> <span
                                                                style="color: #666666">{{ $ebook->created_at->format('d F Y') }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
    <script src="{{ asset('devacademy/member/js/scroll-dashboard.js') }}"></script>
@endpush
