<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
        }

        .maintenance {
            text-align: center; /* Center text */
        }

        img {
            max-width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <section class="maintenance">
        <div class="container">
            <h1 class="text-uppercase fw-bold fs-1 mb-4" style="color: #827761; font-family: 'Poppins', sans-serif;">ooopsss!!!</h1>
            <img src="{{ asset('devacademy/member/img/img-maintenance.png') }}" alt="">
            <p class="fs-5 mt-4" style="color: #827761; font-family: 'Poppins', sans-serif;">Halaman ini masih belum bisa diakses karena sedang dalam masa pemeliharaan</p>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
