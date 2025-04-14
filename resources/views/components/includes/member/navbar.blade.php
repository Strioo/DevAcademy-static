<header class="ps-3 pe-3 pt-2 pb-2 w-100 fixed-top position-fixed bg-white">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a href="{{ route('home') }}" style="text-decoration: none;">
                        <div class="brand-nemolab-icon d-flex align-items-center">
                            <img src="{{ asset('devacademy/member/img/logo-devacademy.png') }}" alt="Logo"
                                width="40" height="40" class="d-inline-block align-text-top">
                            <div class="title-navbar-brand ms-2 d-block">
                                <p class="m-0 p-0 fw-bold">DevAcademy</p>
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
                    <ul class="navbar-nav d-lg-flex align-items-lg-center gap-lg-5 ps-xl-5">

                        <a href="{{ route('home') }}" class="text-decoration-none  pb-2 pb-lg-0">Home</a>

                        <div class="dropdown dropdown-pilih-kelas">
                            <a href="{{ route('member.course') }}" class="m-0 p-0 fw-bold text-decoration-none"
                                style="color: #414142">Kursus</a>
                        </div>

                        <a href="{{ route('home') }}#section-pilih-kursus"
                            class="text-decoration-none  pb-2 pb-lg-0">Kategori</a>

                        <a href="{{ route('home') }}#section-benefit-kelas"
                            class="text-decoration-none  pb-2 pb-lg-0">Benefit</a>

                        <a href="{{ route('home') }}#section-testimoni-kelas"
                            class="text-decoration-none  pb-2 pb-lg-0 pe-5">Testimonial</a>

                        @if (Auth::check())
                            <div class="profile-auth ms-lg-5 mx-lg-0">
                                <div class="dropdown d-flex justify-content-end">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                        <span class="fw-bold">
                                            {{ Auth::user()->name }}
                                        </span>
                                        @if (Auth::user()->avatar != 'default.png')
                                            <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                                class="rounded-5 ms-1" style="width: 42px; height: 42px;"
                                                id="img-profile">
                                        @else
                                            <img src="{{ asset('devacademy/member/img/default.png') }}"
                                                class="rounded-5 ms-1" style="width: 42px; height: 42px;"
                                                id="img-profile">
                                        @endif
                                    </button>

                                    <ul class="dropdown-menu w-100 mt-2 dropdown-logout">
                                        <li><a class="dropdown-item" href="{{ route('member.dashboard') }}">Kelas
                                                Saya</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('member.transaction') }}">Transaksi
                                                Saya</a></li>
                                        <li class="border-bottom pb-3"><a class="dropdown-item"
                                                href="{{ route('member.setting') }}">Pengaturan</a>
                                        </li>
                                        <li class="mt-2">
                                            <a class="dropdown-item" href="{{ route('member.logout') }}"
                                                id="logout-btn">Logout</a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        @else
                            <div class="register-login d-flex align-items-center justify-content-end gap-3">
                                <a href="{{ route('member.register') }}" class="btn px-4 py-2">Daftar</a>
                                <a href="{{ route('member.login') }}" class="btn btn-primary px-4 py-2">Masuk</a>
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
