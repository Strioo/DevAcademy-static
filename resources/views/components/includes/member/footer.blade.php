    <!-- footer web -->
    <footer class="footer" id="footer">
        <div class="container-fluid p-0 m-0">
            <div class="content">
                <div class="row ">
                    <div class="col-12 mb-4 mt-md-0 col-md-4">
                        <div class="brand-nemolab-icon d-flex align-items-center">
                            <img src="{{ asset('devacademy/member/img/logo-devacademy.png') }}" alt="Logo" width="40" height="40"
                                class="d-inline-block align-text-top">
                            <div class="title-navbar-brand ms-2">
                                <p class="m-0 p-0 fw-bold">DevAcademy</p>
                                <p class="m-0 p-0 ">Kursus Online Terbaik</p>
                            </div>
                        </div>
                        <p class="p-0 m-0 w-100 w-sm-75 mt-3 text-white ">Belajar keahlian seputar teknologi kapanpun
                            dan
                            dimanapun</p>
                    </div>
                    <div class="col-3 col-md-2">
                        <h5 class="title text-white fw-bold mb-3">Pilih Kelas</h5>
                        <div class="content-kelas">
                            <a href="{{ route('member.course', ['filter-kelas' => 'UI/UX Designer']) }}" class="m-0 p-0 text-white mb-2">
                                UI/UX Designer
                            </a>
                            <a href="{{ route('member.course', ['filter-kelas' => 'Wordpress Developer']) }}" class="m-0 p-0 text-white mb-2">
                                Wordpress Developer
                            </a>
                            <a href="{{ route('member.course', ['filter-kelas' => 'Fullstack Developer']) }}"  class="m-0 p-0 text-white">
                                Fullstack Developer
                            </a>
                        </div>
                    </div>
                    <div class="col-3 col-md-2">
                        <h5 class="title text-white fw-bold mb-3">Paket Kelas</h5>
                        <div class="content-paket-kelas">
                            <a href="{{ route('member.course', ['filter-paket' => 'paket-kursus']) }}" class="m-0 p-0 text-white mb-2">
                                Kursus
                            </a>
                            <a href="{{ route('member.course', ['filter-paket' => 'paket-ebook']) }}" class="m-0 p-0 text-white mb-2">
                                Ebook
                            </a>
                            <a href="{{ route('member.course', ['filter-paket' => 'paket-bundling']) }}" class="m-0 p-0 text-white">
                                Paket Combo
                            </a>
                        </div>
                    </div>
                    <div class="col-3 col-md-2">
                        <h5 class="title text-white fw-bold mb-3">Pusat Bantuan</h5>
                        <div class="content-paket-kelas d-flex flex-column">
                            <a href="https://wa.me/6289659058849" target="_blank" class="m-0 p-0 text-white mb-2" style="text-decoration: none;">
                                Hubungi CS
                            </a>
                            <a href="#" class="m-0 p-0 text-white mb-2" style="text-decoration: none;">
                                Kirim Email
                            </a>
                        </div>
                    </div>
                    <div class="col-3 col-md-2">
                        <h5 class="title text-white fw-bold mb-3">Media Sosial</h5>
                        <div class="content-paket-kelas d-flex flex-column">
                            <a href="https://www.instagram.com/dev.academy2025/" target="_blank" class="m-0 p-0 text-white mb-2" style="text-decoration: none;">
                                Instagram
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="copyright d-sm-flex justify-content-sm-center align-items-sm-center pt-sm-4 pb-sm-4">
                <p class="m-0 p-0 text-white">© 2024 All Rights Reserved. Design by <a href="https://vibrant.web.id/">DevAcademy</a></p>
            </div>
        </div>
    </footer>
    <!-- end footer -->
