@extends('components.layouts.member.dashboard')

@section('title', 'Belajar Kursus Online Kapan Saja dan Dimanapun')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/home.css') }} ">
@endpush

@section('content')
    <!-- Section Hero -->
    <section class="section-hero-img d-flex align-items-center mb-5" id="section-hero-img">
        <div class="row">
            <div class="col-md-6 mt-lg-5" data-aos="zoom-out">
                <div class="text-center text-md-start me-md-3">
                    <h1 class="fw-bold">Belajar <span class="custom-underline">Kursus Online</span> <br> Gratis, Fleksibel
                        Kapan <br class="d-xl-block d-md-none"> Saja & <span class="custom-underline cu-2">di Mana
                            Saja!</span></h1>
                    <p>Belajar keahlian seputar teknologi dari pemula hingga ahli, dapatkan berbagai macam kelas mulai
                        yang gratis hingga yang berbayar</p>
                    <div class="d-flex align-items-center avatar-btn-group">
                        <a href="{{ route('member.course') }}" class="btn btn-primary px-4" style="padding: 14px">Mulai
                            Belajar</a>
                        <div class="d-flex flex-column mt-md-0 mt-sm-3 ms-md-4 ms-sm-0 flex-important">
                            <div class="avatar-group">
                                <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" class="rounded-5 ms-1"
                                    style="width: 30px; height: 30px;">
                                <img src="{{ asset('devacademy/member/img/dumy-2.jpg') }}" class="rounded-5"
                                    style="width: 30px; height: 30px;">
                                <img src="{{ asset('devacademy/member/img/dumy-4.jpg') }}" class="rounded-5"
                                    style="width: 30px; height: 30px;">
                                <img src="{{ asset('devacademy/member/img/dumy-5.jpg') }}" class="rounded-5"
                                    style="width: 30px; height: 30px;">
                                <img src="{{ asset('devacademy/member/img/dumy-6.jpg') }}" class="rounded-5"
                                    style="width: 30px; height: 30px;">
                            </div>
                            <p class="mt-1 mb-0 fs-6">Lebih dari <span class="text-black">890+</span> Orang telah bergabung
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block align-items-center" data-aos="zoom-out" data-aos-delay="100">
                <img class="ms-4 float-end" src="{{ asset('devacademy/member/img/hero-img.png') }}" alt=""
                    style="width:650px;">
            </div>
        </div>
    </section>

    <section class="section-pilh-kelas" id="section-pilih-kelas" data-aos="fade-up">
        <div class="container-fluid p-0 m-0">
            <div class="title-pilih-kelas d-flex justify-content-between align-items-center pt-5">
                <div class="title-group ">
                    <h1 class="title-kelas fw-bold" style="margin-top: 80px;">Pilihan Kelas</h1>
                    <p class="subtitle-kelas">Beralih menjadi profesional dari sekarang dengan memilih kelas dan mulai
                        belajar</p>
                </div>
                <a href="{{ route('member.course') }}" class="btn btn-primary fw-bold d-lg-block d-sm-none sm-none">Lihat
                    Kelas Lainnya</a>
            </div>
            <div class="content-kelas mt-2 mt-md-4">
                <div class="row m-0 p-0 ">
                    @foreach ($courses as $course)
                        @if ($course)
                            <div class="col-md-6 col-xl-3 col-lg-4 col-12 d-flex justify-content-center my-2 pb-2">
                                <div class="card d-flex d-md-block" id="card-hover">
                                    <div class="card-head ">
                                        @if ($course->cover && $course->cover != '' && file_exists(public_path('storage/images/covers/' . $course->cover)))
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}"
                                                class="card-img-top" alt="{{ $course->name }}" />
                                        @else
                                            <img src="{{ asset('devacademy/member/img/courseBG.png') }}"
                                                class="card-img-top" alt="{{ $course->name }}" />
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="title-card">
                                            <h5 class="fw-bold truncate-text">
                                                {{ $course->name }}
                                            </h5>
                                        </div>
                                        <div class="btn-group-harga d-flex justify-content-between mt-md-3">
                                            <div class="avatar m-0 fw-bold me-1 d-flex">
                                                @if ($course->users && $course->users->avatar && $course->users->avatar !== 'default.png')
                                                    <img class="me-2"
                                                        src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                                                        alt="" />
                                                @else
                                                    <img class="me-2"
                                                        src="{{ asset('devacademy/member/img/default.png') }}"
                                                        alt="" />
                                                @endif
                                                <p class="ms-2 align-items-center justify-content-center">
                                                    {{ $course->users ? $course->users->name : '-' }}</p>
                                            </div>
                                            <div class="harga">
                                                <div class="d-flex sertifikat">
                                                    <img class="me-3 icon-serti" id="check-icon"
                                                        src="{{ asset('devacademy/member/img/icon/check-serti.svg') }}"
                                                        alt="" />
                                                    <p class="p-0 m-0 fw-semibold">Sertifikat</p>
                                                </div>
                                                <p class="p-0 fw-semibold float-end mt-2 mb-0 price">
                                                    {{ $course->price == 0 ? 'Gratis' : 'Rp' . number_format($course->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ route('member.course.join', $course->slug) }}"
                                            class="btn btn-warning btn-harga mt-3">Mulai</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('member.course') }}" class="btn btn-primary fw-bold mt-4 d-md-none">Lihat Kelas
                        Lainnya</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pilih-kursus" id="section-pilih-kursus" data-aos="fade-up">
        <div class="container-fluid p-5">
            <div class="title-pilih-kursus" style="margin-top: 130px;">
                <h1 class="title-kelas fw-bold">Pilih Kursus Berdasarkan Kategori</h1>
                <p>Temukan kursus yang sesuai dengan minatmu dan mulai belajar dari sekarang!</p>
            </div>
            <div class="d-flex flex-md-row card-group gap-3">
                <div class="card p-4">
                    <img src="{{ asset('devacademy/member/img/icon/pentool-hover.png') }}" alt="" class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                    <h4 class="mb-2">Graphic Designer</h4>
                    <p class="mb-0">Jadi ahli dalam desain visual yang menarik</p>
                </div>
                <div class="card p-4">
                    <img src="{{ asset('devacademy/member/img/icon/UI-UX-designer.png') }}" alt="" class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                    <h4 class="mb-2">UI/UX Designer</h4>
                    <p class="mb-0">Belajar desain pengalaman dan tampilan pengguna</p>
                </div>
                <div class="card p-4">
                    <img src="{{ asset('devacademy/member/img/icon/fe-dev.png') }}" alt="" class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                    <h4 class="mb-2">Frontend Developer</h4>
                    <p class="mb-0">Bangun tampilan website yang keren</p>
                </div>
                <div class="card p-4">
                    <img src="{{ asset('devacademy/member/img/icon/be-dev.png') }}" alt="" class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                    <h4 class="mb-2">Backend Developer</h4>
                    <p class="mb-0">Kelola server dan database dengan mudah</p>
                </div>
                <div class="card p-4">
                    <img src="{{ asset('devacademy/member/img/icon/wordpress-dev.png') }}" alt="" class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                    <h4 class="mb-2">WordPress Developer</h4>
                    <p class="mb-0">Buat website profesional pakai WordPress</p>
                </div>
            </div>
        </div>
    </section>


    <!-- section 4 -->
    <section class="section-benefit-kelas my-5" id="section-benefit-kelas" data-aos="fade-up">
        <div class="container-fluid">
            <div class="row align-items-center my-5 mx-md-3">
                <div class="col-md-6">
                    <div class="me-md-4 text-center text-md-start">
                        <h1 class="fw-bold">Benefit Yang Bisa Kamu Dapatkan Jika Belajar Disini</h1>
                        <ul class="check-active-group mt-3 list-unstyled"> <!-- Changed to ul and added list-unstyled -->
                            <li class="check-active d-flex align-items-center" data-aos="zoom-out">
                                <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                            </li>
                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                data-aos-delay="100">
                                <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                <p class="m-0 p-0 ms-2">Mendapat sertifikat pembelajaran resmi</p>
                            </li>
                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                data-aos-delay="200">
                                <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                            </li>
                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                data-aos-delay="300">
                                <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                <p class="m-0 p-0 ms-2">Konsultasi dengan mentor secara langsung</p>
                            </li>
                        </ul>
                        <a href="{{ route('member.course') }}" class="btn btn-primary px-4 mt-4">Gabung Kelas</a>
                    </div>
                </div>

                <div class="col-md-6 justify-content-center d-none d-md-flex" id="service" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="person-image">
                        <img src="{{ asset('devacademy/member/img/hero2-img.png') }}" class="img-fluid" alt="Person">
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end section 4 -->


    <!-- section 5 -->
    <section class="section-testimoni-kelas mt-5 me-0" id="section-testimoni-kelas" data-aos="fade-up">
        <div class="container-fluid row p-0 m-0">
            <div class="testimoni-title pb-5 d-flex">
                <h1 class="fw-bold ms-3">Selangkah Lebih Maju menjadi <br> Professional!!</h1>
                <p class="float-end">Jangan ragu untuk bergabung di kelas-kelas kami! Banyak pengguna sudah
                    membuktikan dengan belajar di kelas kami</p>
            </div>
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
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
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
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
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
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
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
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
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
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
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
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
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
    <!-- end section 5 -->

    <!-- section 6 -->
    <section class="section-meningkatkan-skill mt-5" id="section-pusat-bantuan" data-aos="fade-up">
        <div class="container-fluid row background-image p-0 m-0">
            <div class="col-md-6 ms-md-5 ms-sm-0">
                <div class="text-center text-md-start" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="fw-bold text-white" style="margin-top: 55px ;">Siap Meningkatkan Karier dan Skill Anda?
                    </h1>
                    <p class="me-md-5 text-white">Gabung bersama ribuan pelajar lainnya yang telah memulai perjalanan
                        mereka menuju kesuksesan. Daftar sekarang dan jadilah ahli di bidang yang Anda impikan</p>
                    <a href="#" class="btn btn-primary px-4" style="margin-bottom: 155px;">Mulai Belajar</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end section 6 -->
@endsection


@push('addon-script')
    <script></script>
@endpush
