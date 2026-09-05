# SIMPEL — Sistem Informasi Pendukung Kelulusan

Sistem ini dibangun menggunakan Laravel untuk membantu menentukan kelulusan peserta pelatihan berdasarkan beberapa kriteria, seperti nilai pretest, nilai posttest, nilai praktik, dan kehadiran. Metode yang digunakan dalam pengambilan keputusan adalah **Weighted Product (WP)**.

## Fitur Utama

- Manajemen Kriteria dan Bobot
- Input nilai peserta berdasarkan kriteria
- Perhitungan otomatis menggunakan metode WP
- Hasil keputusan kelulusan peserta

## Teknologi yang Digunakan

- Laravel 11
- PHP 8.2.21
- Bootstrap 5
- Font Awesome
- MySQL

## Instalasi dan Penggunaan

Ikuti langkah-langkah berikut untuk menjalankan project ini secara lokal:

### 1. Clone Repository

```bash
git clone https://github.com/M-Surya-S/SIMPEL.git
```

### 2. Pindah Ke Folder Project

```bash
cd SIMPEL
```

### 3. Install Dependensi

```bash
composer install
npm install && npm run dev
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Konfigurasi Environment

Edit file .env dan sesuaikan dengan pengaturan database lokal Anda:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpel
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Generate Key dan Jalankan Migrasi

```bash
php artisan key:generate
php artisan migrate
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi melalui: http://localhost:8000

## Struktur Folder Penting

- `app/Models` — Model Eloquent  
- `app/Http/Controllers` — Logic dari fitur  
- `resources/views` — Blade templates  
- `routes/web.php` — Routing aplikasi  

## Catatan

- Pastikan web server (XAMPP/Laragon) aktif saat menjalankan aplikasi.
- Aplikasi ini menggunakan metode WP untuk perhitungan skor akhir secara otomatis.


© 2025 - SIMPEL (Sistem Informasi Pendukung Kelulusan)
