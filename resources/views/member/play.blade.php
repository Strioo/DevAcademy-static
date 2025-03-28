@extends('components.layouts.member.app')

@section('title', 'Play Kursus')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/play.css') }} ">
@endpush

@section('content')
    <!-- section 1 -->
    <section class="view-course-section" id="view-course-section">
        <div class="container-fluid container-non-rating">
            <div class="row justify-content-between video">
                <div class="col-11 col-lg-8 ">
                    <iframe id="youtubePlayer" width="100%" height="100%" src="{{ $play->video }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="col-11 col-lg-4 mt-5 mt-lg-0  ps-0 py-3">
                    <div class="card mt-4 mt-sm-0">
                        <div class="card-body overflow-y-scroll ps-lg-0 ps-sm-4">
                            @foreach ($chapters as $chapter)
                                <div class="content mb-5">
                                    <h5 class="m-0 p-0">{{ $chapter->name }}</h5>
                                    <div class="link-source mt-3">
                                        @foreach ($chapter->lessons as $lesson)
                                            <div
                                                class="link d-flex align-items-center mb-3 {{ request()->route('episode') === $lesson->episode ? 'active-course' : '' }}">
                                                <a href="{{ route('member.course.play', ['slug' => $slug, 'episode' => $lesson->episode]) }}"
                                                    class="text-wrap flex-grow-1 play-video "
                                                    data-episode-id="{{ $lesson->id }}"
                                                    data-course-id="{{ $courses->id }}">{{ $lesson->name }}</a>
                                                {{-- <img src="{{ asset('devacademy/member/img/check-course.png') }}"
                                                    alt=""
                                                    class="check-icon {{ in_array($lesson->id, $epComplete) ? '' : 'd-none' }}"
                                                    id="check-icon-{{ $lesson->id }}"> --}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="m-0 p-0 mt-5">
                Episode: {{ $play->name }}
            </h2>
            {{-- <div class="link-group d-block mt-3 mt-sm-4">
                @if (!is_null($paketKelas))
                    <a href="{{ route('member.ebook.join', $paketKelas->ebook->slug) }}" class="btn btn-primary w-100">Belajar E-Book</a>
                @endif
                <a href="{{ route('member.course.detail', $courses->slug) }}" class="btn btn-secondary w-100 mt-1">Detail Kelas</a>
            </div> --}}
            <h2 class="m-0 p-0 mt-3">
                Deskripsi Khusus
            </h2>
            <p class="deskripsi-text mt-2 mb-4">
                Di kursus ini kamu akan belajar bagaimana cara memanfaatkan teknologi yang sedang marak digunakan yaitu
                ChatGPT untuk mempermudah kamu saat membuat sebuah desain website ataupun aplikasi. Segera gabung di kursus
                kami untuk belajar mengenai dunia UI/UX Designer lebih dalam.
            </p>
            <hr class="line">
            <h2 class="m-0 p-0 mt-4">
                Dalam Materi ini
            </h2>
            <div class="group-materi d-flex gap-5 mt-3 mb-4">
                <a href="{{ $courses->link_grub }}">
                    <div class="card d-flex flex-row p-3">
                        <img src="{{ asset('devacademy/member/img/img-konsultasi.png') }}" alt="">
                        <div class="card-tittle ms-3">
                            <h5 class="card-title m-0">Grup Diskusi</h5>
                            <p class="card-text">Gabung Grup Diskusi</p>
                        </div>
                    </div>
                </a>
                @if (!$checkReview)
                    <a href="{{ route('member.review', $courses->slug) }}">
                    @else
                        <a href="{{ route('member.sertifikat', $courses->slug) }}">
                @endif
                <div class="card d-flex flex-row p-3">
                    <img src="{{ asset('devacademy/member/img/img-achievement.png') }}" alt="">
                    <div class="card-tittle ms-3">
                        <h5 class="card-title m-0">Unduh Sertifikat</h5>
                        <p class="card-text">Unduh Sertifikat Anda</p>
                    </div>
                </div>
                </a>
                @if ($courses->resources != 'null')
                    <a href="{{ $courses->resources }}">
                        <div class="card d-flex flex-row p-3">
                            <img src="{{ asset('devacademy/member/img/img-asset.png') }}" alt="">
                            <div class="card-tittle ms-3">
                                <h5 class="card-title m-0">Asset Belajar</h5>
                                <p class="card-text">Unduh Asset Belajar</p>
                            </div>
                        </div>
                    </a>
                @endif
                @if (!$checkReview)
                    <a href="{{ route('member.review', $courses->slug) }}">
                    @else
                        <a href="{{ route('member.sertifikat', $courses->slug) }}">
                @endif
                <div class="card d-flex flex-row p-3">
                    <img src="{{ asset('devacademy/member/img/img-review.png') }}" alt="">
                    <div class="card-tittle ms-3">
                        <h5 class="card-title m-0">Review Kelas</h5>
                        <p class="card-text">Review untuk feedback</p>
                    </div>
                </div>
                </a>
            </div>
            <hr class="line">
            <h2 class="m-0 p-0 mt-4">
                Rating Materi
            </h2>
        </div>
        <section id="section-rating">
            <div class="container-fluid row p-0 m-0">
                <div class="row  p-0 mt-4" id="testimonials">
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
    </section>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const playVideoLinks = document.querySelectorAll('.play-video');

            playVideoLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Tidak perlu fetch, langsung redirect ke route member.course.play
                    e.preventDefault();
                    window.location.href = this.href;
                });
            });
        });
    </script>
@endpush
