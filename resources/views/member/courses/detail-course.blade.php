@extends('components.layouts.member.app')

@section('title', 'Devacademy - Kursus Online')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/detail-course.css') }} ">
@endpush

@section('content')
    <section class="detail-course-section" id="detail-course-section">
        <div class="container">
            <a href="{{ route('member.course.join', $courses->slug) }}">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="m-0 p-0 mt-5 mb-4 text-center">{{ $courses->name }}</h4>
            <div class="content-images d-flex justify-content-center">
                @if ($courses->cover !=null)
                <img src="{{ asset('storage/images/covers/' . $courses->cover) }}" alt="" class="img-fluid" width="900" height="800" style="border-radius: 15px; box-shadow: rgba(32, 32, 32, 0.322) 0px 8px 24px; object-fit: cover">
                @else
                <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" alt="" class="img-fluid" width="900" height="800" style="border-radius: 15px; box-shadow: rgba(32, 32, 32, 0.322) 0px 8px 24px; object-fit: cover">
                @endif
            </div>
            <div class="subcontent-images mt-5">
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-4 mb-4">
                        <a href="{{ $courses->link_grub }}" class="shadow">
                            <img src="{{ asset('devacademy/member/img/img-konsultasi.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Gabung Grub Konsultasi</p>
                                <p class="m-0 p-0">Konsultasi Dengan Mentor</p>
                            </div>
                        </a>
                    </div>
                    @if ($checkSertifikat == true)
                        <div class="col-12 col-sm-6 col-xl-4 mb-4">
                            @if (!$checkReview)
                                <a href="{{ route('member.review', $courses->slug) }}" class="shadow">
                                @else
                                    <a href="{{ route('member.sertifikat', $courses->slug) }}" class="shadow">
                            @endif
                            <img src="{{ asset('devacademy/member/img/img-achievement.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Unduh Sertifikat</p>
                                <p class="m-0 p-0">Unduh Sertifikat Anda</p>
                            </div>
                            </a>
                        </div>
                    @endif
                    @if ($courses->resources != 'null')
                        <div class="col-12 col-sm-6 col-xl-4 mb-4">
                            <a href="{{ $courses->resources }}" class="shadow">
                                <img src="{{ asset('devacademy/member/img/img-asset.png') }}" alt="">
                                <div class="group-title-subtitle ms-3">
                                    <p class="m-0 p-0">Asset Belajar</p>
                                    <p class="m-0 p-0">Unduh Asset disini</p>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="detail-courses mt-5 shadow-sm">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Detail</h5>
                    </div>
                    <div class="card-body d-flex align-items-center p-0 pt-3">
                        <div class="text">
                            <p class="m-0 p-0">Tanggal rilis </p>
                            <p class="m-0 p-0">Jenis paket </p>
                            <p class="m-0 p-0">Tingkatan </p>
                        </div>
                        <div class="text-titik-koma">
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                        </div>
                        <div class="text-content">
                            <p class="m-0 p-0 ms-3">{{ $courses->created_at->format('d F Y') }}</p>
                            <p class="m-0 p-0 ms-3">
                                @if ($courses->type == 'free')
                                    Gratis
                                @else
                                    Berbayar
                                @endif
                            </p>
                            <p class="m-0 p-0 ms-3">
                                @if ($courses->type == 'beginner')
                                    Pemula
                                @elseif ($courses->type == 'intermediate')
                                    Menengah
                                @else
                                    Ahli
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description-courses mt-5 shadow-sm">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Deskripsi Kursus</h5>
                    </div>
                    <div class="card-body d-flex align-items-center p-0 pt-3">
                        <p class="m-0 p-0 ">{{ $courses->description }}</p>
                    </div>
                </div>
            </div>
            <div class="tools-courses mt-5 shadow-sm">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Tools</h5>
                    </div>
                    <div class="card-body p-0 pt-3 ">

                        <div class="row">
                            @foreach ($coursetools->tools as $tool)
                                <div
                                    class="col-6 col-sm-2 tools-group d-flex justify-content-center align-items-center flex-column">
                                    <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}" alt=""
                                        width="70px" height="70px">
                                    <p class="m-0 p-0 pt-1">{{ $tool->name_tools }}</p>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <div class="testimoni mt-5">
                <h1>Testimoni</h1>
                <div class="col-12 mt-4">
                    <div class="row card-testimoni col-12  d-none d-md-flex">
                        @foreach ($reviews as $index => $review)
                            <div class="col-12 col-md-6 review-item" data-index="{{ $index }}"
                                style="{{ $index >= 2 ? 'display: none;' : '' }}">
                                <div class="card mb-4 border-0">
                                    <div class="card-body">
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('storage/images/avatars/' . ($review->user->avatar ?? 'default-avatar.png')) }}"
                                                alt="" width="45" height="45" style="border-radius: 50%">
                                            <div class="name ms-3">
                                                <h5 class="card-title m-0 fw-bold">{{ $review->user->name }}</h5>
                                                <p class="m-0">{{ $review->user->proffession }}</p>
                                            </div>
                                        </div>
                                        <p class="card-text p-0 m-0 mt-2">{{ $review->note }}.</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-container d-md-none">
                        <div class="swiper-wrapper">
                            @foreach ($reviews as $review)
                                <div class="swiper-slide testimoni-card review-item">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('storage/images/avatars/' . ($review->user->avatar ?? 'default-avatar.png')) }} "
                                                    alt="User Avatar" class="avatar-img" width="45" height="45"
                                                    style="border-radius: 50%">

                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">{{ $review->user->name }}</h5>
                                                    <p class="m-0">
                                                        {{ $review->user->profession ?? 'Profession not specified' }}</p>
                                                </div>
                                            </div>
                                            <p class="card-text p-0 m-0 mt-2">{{ $review->note }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="navtabs-more-testimoni d-flex justify-content-center  d-none d-md-flex">
                        <button class="btn btn-primary px-4 pt-2 pb-2 " id="show-more-btn">
                            Lihat Lainnya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.getElementById('show-more-btn');
            let currentLimit = 4;

            showMoreBtn.addEventListener('click', function() {
                const reviews = document.querySelectorAll('.review-item');
                for (let i = currentLimit; i < currentLimit + 4 && i < reviews.length; i++) {
                    reviews[i].style.display = 'block';
                }
                currentLimit += 4;
                if (currentLimit >= reviews.length) {
                    showMoreBtn.style.display = 'none';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let swiper;

            function initializeSwiper() {
                if (window.innerWidth < 768 && !swiper) {
                    swiper = new Swiper('.swiper-container', {
                        slidesPerView: 1,
                        spaceBetween: 10,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                    });
                } else if (window.innerWidth >= 768 && swiper) {
                    swiper.destroy(true, true);
                    swiper = undefined;
                }
            }
            initializeSwiper();
            window.addEventListener('resize', initializeSwiper);
        });
    </script>
@endpush
