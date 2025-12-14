@extends('components.layouts.member.app')

@section('title', 'Devacademy - Detail Kursus')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/joincourse.css') }}">
@endpush

@section('content')
    <main class="container-fluid mt-5 pt-5 pb-5 px-0">
        <div class="container px-0">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-tittle p-4">
                        <h1 data-aos="fade-right" class="mb-4" style="word-wrap: break-word; white-space: normal;">{{ $courses->name }}
                        </h1>
                        <h5 class="mt-3 mb-3">Deskripsi Kursus</h5>
                        <p class="mb-4" style="max-width: 90%;">{{ $courses->sort_description }}</p>
                        <div class="keuntungan mt-3">
                            <h5>Keuntungan belajar kelas ini</h5>
                            <ul class="check-active-group mt-3 list-unstyled d-flex gap-4">
                                <!-- Changed to ul and added list-unstyled -->
                                <li class="check-active d-flex align-items-center" data-aos="zoom-out">
                                    <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                                </li>
                                <li class="check-active d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                                    <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Asset Gratis</p>
                                </li>
                                <li class="check-active d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                                    <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Belajar Gratis</p>
                                </li>
                            </ul>
                        </div>

                        @if ($courses->price != 0)
                            <h4 class="price ">Rp. {{ number_format($courses->price, 0, ',', '.') }}</h4>
                        @else
                            <h4 class="price ">Gratis</h4>
                        @endif


                        @if ($transaction)
                            @if ($transaction->status == 'pending')
                                <a href="#" class="buy btn btn-primary py-2 w-100">Dalam Proses Pembayaran</a>
                            @elseif ($transaction->status == 'success')
                                @if ($lesson)
                                    <a href="{{ route('member.course.play', ['slug' => $courses->slug, 'episode' => $lesson->slug_episode]) }}"
                                        class="buy btn btn-primary py-2 w-100">Mulai Belajar</a>
                                @else
                                    <a href="#" class="buy btn btn-primary py-2 w-100">Kelas Dalam Pembaruan</a>
                                @endif
                            @else
                                <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                    class="buy btn btn-primary py-2 w-100">Ambil Kelas</a>
                            @endif
                        @else
                            <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                class="buy btn btn-primary py-2 w-100">Ambil Kelas</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-preview p-0">
                        @if ($courses->cover && $courses->cover != '' && file_exists(public_path('storage/images/covers/' . $courses->cover)))
                            <img src="{{ asset('storage/images/covers/' . $courses->cover) }}" alt="">
                        @else
                            <img src="{{ asset('devacademy/member/img/courseBG.png') }}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-8 mt-4">
                    <div class="card card-materi p-4">
                        <h5 class="text-black mb-3">Materi</h5>
                        {!! $courses->long_description !!}
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card card-detail p-4">
                        <h5 class="text-black mb-3">Detail</h5>
                        <div class="d-flex">
                            <div class="head">
                                <ul class="p-0 m-0 d-flex flex-column gap-3">
                                    <li>Tanggal rilis </li>
                                    <li>Tanggal Update </li>
                                    <li>Jenis Paket </li>
                                    <li>Tingkatan</li>
                                </ul>
                            </div>
                            <div class="answer ms-4">
                                <ul class="m-0 d-flex flex-column gap-3">
                                    <li>: 2 Oktober 2024</li>
                                    <li>: -</li>
                                    <li>: Kursus</li>
                                    <li>: Pemula</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card card-tools mt-2 d-flex p-4">
                        <h5 class="mb-3">Tools</h5>
                        <div class="container-tools d-flex gap-3">
                            <div class="tools d-flex mt-3 flex-wrap gap-3 align-items-center justify-content-center">
                                @foreach ($coursetools->tools as $tool)
                                    <div class="card-tool py-4 px-4 d-flex flex-column align-items-center justify-content-center">
                                        @php
                                            $iconMap = [
                                                'Figma' => 'Figma.svg',
                                                'Adobe XD' => 'Adobe_XD.png',
                                                'Flutter' => 'flutter.png',
                                                'Laravel' => 'Laravel.png',
                                                'React' => 'react.png',
                                                'Node.js' => 'nodejs.svg',
                                                'Nodejs' => 'nodejs.svg',
                                                'GitHub' => 'github.svg',
                                                'Postman' => 'postman.png',
                                                'Visual Studio Code' => 'visual-studio-code.png',
                                                'VS Code' => 'visual-studio-code.png',
                                            ];
                                            $iconFile = $iconMap[$tool->name_tools] ?? null;
                                            $iconPath = $iconFile ? 'devacademy/member/img/icon/tech-stack/' . $iconFile : 'storage/images/logoTools/' . $tool->logo_tools;
                                        @endphp
                                        <img src="{{ asset($iconPath) }}"
                                            alt="{{ $tool->name_tools }}" class="" width="50" height="50"
                                            style="object-fit: contain;">
                                        <p class="mb-0 mt-3 align-middle text-center fw-medium">{{ $tool->name_tools }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-testimoni-kelas mt-5 me-0 px-0" id="section-testimoni-kelas" data-aos="fade-up">
            <div class="container">
                <div class="testimoni-title pb-5 col-8">
                    <h1 data-aos="fade-right">Testimoni</h1>
                </div>
            </div>
            <div class="container-fluid row p-0 m-0">
                <div class="row  p-0" id="testimonials">
                    <div class="col-md-12 p-0 carousel-container">
                        <div class="carousel-track d-flex" style="margin-left: -500px">
                            <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                                <div class="card mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-2">
                                            <div
                                                class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                                <img class="mx-auto"
                                                    src="{{ asset('devacademy/member/img/icon/icon-testimonial.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang
                                                cara
                                                memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover"
                                                    alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                    <p class="m-0">UI/UX Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                                <div class="card mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-2">
                                            <div
                                                class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                                <img class="mx-auto"
                                                    src="{{ asset('devacademy/member/img/icon/icon-testimonial.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang
                                                cara
                                                memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover"
                                                    alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                    <p class="m-0">UI/UX Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                                <div class="card mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-2">
                                            <div
                                                class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                                <img class="mx-auto"
                                                    src="{{ asset('devacademy/member/img/icon/icon-testimonial.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang
                                                cara
                                                memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover"
                                                    alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                    <p class="m-0">UI/UX Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Duplicate Cards for Infinite Effect -->
                            <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                                <div class="card mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-2">
                                            <div
                                                class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                                <img class="mx-auto"
                                                    src="{{ asset('devacademy/member/img/icon/icon-testimonial.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang
                                                cara
                                                memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover"
                                                    alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                    <p class="m-0">UI/UX Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                                <div class="card mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-2">
                                            <div
                                                class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                                <img class="mx-auto"
                                                    src="{{ asset('devacademy/member/img/icon/icon-testimonial.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang
                                                cara
                                                memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover"
                                                    alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                    <p class="m-0">UI/UX Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                                <div class="card mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-2">
                                            <div
                                                class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                                <img class="mx-auto"
                                                    src="{{ asset('devacademy/member/img/icon/icon-testimonial.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang
                                                cara
                                                memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover"
                                                    alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                    <p class="m-0">UI/UX Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    </main>
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
