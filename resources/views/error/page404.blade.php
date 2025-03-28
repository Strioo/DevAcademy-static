<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        .container-fluid {
            padding: 0 !important;
        }

        @media screen and (min-width: 768px) and (max-width: 992px) {
            h1 {
                font-size: 65px !important;
            }

            .img-404 {
                height: 350px;
                top: 35% !important;
            }
        }

        @media (max-width: 576px) {

            .col-5,
            .col-7 {
                display: none !important;
            }

            h1 {
                color: #ff7700;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 d-flex align-items-center">
                <div class="position-absolute top-0 mt-5 ms-5">
                    <a href="{{ route('home') }}"><img src="{{ asset('devacademy/member/img/logo.png') }}" alt=""
                            width="120" /></a>
                </div>
                <div class="px-5">
                    <h1 class="m-0" style="font-size: 75px">OOPS ..</h1>
                    <h3 class="fw-normal">Halaman Tidak ditemukan</h3>
                    <p class="m-0 fw-light" style="font-size: 17px; color: #bbbbbb">Halaman yang Anda cari tidak ada
                        atau terjadi kesalahan lainnya, kembali ke halaman beranda.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3 fw-medium text-white">Kembali ke Beranda</a>
                </div>
            </div>
            <div class="col-7">
                <div class="position-relative w-100">
                    <img src="{{ asset('devacademy/member/img/bg-404.png') }}" alt=""
                        style="height: 100vh; width: 100%" />
                    <img src="{{ asset('devacademy/member/img/404.png') }}" alt="" height="500"
                        class="position-absolute img-404" style="left: 20%; top: 10%" />
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center d-md-none" style="height: 100vh">
                <div class="position-absolute start-0 top-0 mt-5 ms-5">
                    <a href="{{ route('home') }}"><img src="{{ asset('devacademy/member/img/logo.png') }}" alt=""
                            width="100" /></a>
                </div>
                <div>
                    <img src="{{ asset('devacademy/member/img/404-mobile.png') }}" alt="" height="200" />
                    <h1 class="m-0 mt-3" style="font-size: 50px">OOPS ..</h1>
                    <h4 class="fw-normal">Halaman Tidak ditemukan !!</h4>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
