# DevAcademy

DevAcademy adalah platform pembelajaran daring yang menyediakan kursus pemrograman gratis dan berbayar dengan fitur pembelajaran berbasis video. Platform ini dibangun menggunakan Laravel dan Bootstrap.

## Tech Stack

- **Backend:** Laravel 10
- **Frontend:** Blade Template + Bootstrap 5
- **Database:** MySQL
- **Local Server:** Laragon
- **Email Testing:** Mailtrap.io
- **Payment Gateway:** Midtrans

## Fitur Utama

- Kursus Berbasis Video
- Manajemen Kursus (Buat, Edit, Hapus)
- Sistem Transaksi
- Sertifikat

## Instalasi

```bash
git clone https://github.com/vebriannn/DevAcademy.git
cd DevAcademy

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate

# Atur konfigurasi database di file .env
php artisan migrate --seed
php artisan serve
