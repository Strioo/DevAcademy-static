<!-- navbar -->
<header class="ps-3 pe-3 pt-2 pb-2 w-100 fixed-top position-fixed bg-white shadow-sm">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a href="{{ route('home') }}" style="text-decoration: none;">
                        <div class="brand-nemolab-icon d-flex align-items-center">
                            <img src="{{ asset('devacademy/member/img/logo-devacademy.png') }}" alt="Logo" width="40"
                                height="40" class="d-inline-block align-text-top">
                            <div class="title-navbar-brand ms-2 d-block">
                                <p class="m-0 p-0 fw-bold">Devacademy</p>
                                <p class="m-0 p-0 ">Kursus Online Terbaik</p>
                            </div>
                        </div>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="">
                        <img src="{{ asset('devacademy/member/img/icon-nav.png') }}" alt="">
                    </span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <ul class="navbar-nav d-lg-flex align-items-lg-center gap-lg-4 ps-xl-5">

                        <a href="{{ route('home') }}" class="text-decoration-none  pb-2 pb-lg-0">Home</a>

                        <div class="dropdown dropdown-pilih-kelas">
                            <button
                                class="btn btn-secondary dropdown-toggle d-flex align-items-center p-0 pt-2 pt-lg-0 pb-2 pb-lg-0"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Kelas
                                <box-icon name='chevron-down' color="#414142"></box-icon>
                            </button>
                            <ul class="dropdown-menu mt-lg-3 mb-3">
                                <div class="head-submenu d-flex justify-content-between align-items-center">
                                    <p class="m-0 p-0 fw-bold">Pilihan Kelas</p>
                                    <a href="{{ route('member.course') }}" class="m-0 p-0">Lihat Semua</a>
                                </div>
                                <div class="content-submenu mt-2 ">
                                    <div class="row m-0 ">
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'UI/UX Designer']) }}">UI
                                                UX Designer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Frontend Developer']) }}">Frontend
                                                Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Wordpress Developer']) }}">Wordpress
                                                Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Backend Developer']) }}">Backend
                                                Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Grapics Designer']) }}">Grapics
                                                Designer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Fullstack Developer']) }}">Fullstack Developer</a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <a href="{{ route('home') }}#section-pilih-kursus" class="text-decoration-none  pb-2 pb-lg-0">Kategori</a>

                        <a href="{{ route('home') }}#section-benefit-kelas" class="text-decoration-none  pb-2 pb-lg-0">Benefit</a>

                        <a href="{{ route('home') }}#section-testimoni-kelas" class="text-decoration-none  pb-2 pb-lg-0 pe-5">Testimonial</a>

                        <div class="profile-auth ms-lg-5 mx-lg-0">
                            <div class="dropdown d-flex justify-content-end">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                    <span class="fw-bold">
                                        {{ Auth::user()->name }}
                                    </span>
                                    @if (Auth::user()->avatar != 'default.png')
                                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                            class="rounded-5 ms-1" style="width: 42px; height: 42px;" id="img-profile">
                                    @else
                                        <img src="{{ asset('devacademy/member/img/default.png') }}"
                                            class="rounded-5 ms-1" style="width: 42px; height: 42px;" id="img-profile">
                                    @endif
                                </button>

                                <ul class="dropdown-menu w-100 mt-2 dropdown-logout">
                                    @if (!Request::routeIs('member.setting') && !Request::routeIs('member.setting.*'))
                                        <li><a class="dropdown-item" href="{{ route('member.dashboard') }}">Kelas
                                                Saya</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('member.transaction') }}">Transaksi
                                                Saya</a></li>
                                        <li class="border-bottom pb-3"><a class="dropdown-item"
                                                href="{{ route('member.setting') }}">Pengaturan</a>
                                        </li>
                                    @endif
                                    <li class="mt-2">
                                        <a class="dropdown-item" href="{{ route('member.logout') }}"
                                            id="logout-btn">Logout</a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </ul>
                </div>
            </div>
        </nav>

    </div>
</header>
