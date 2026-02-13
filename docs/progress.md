# Laporan Pengembangan TemuEvent

## Ringkasan

TemuEvent adalah platform terintegrasi untuk menemukan dan mengelola event terbaik di Indonesia. Platform ini memungkinkan event organizer untuk mendaftarkan dan mempublikasikan acara yang mereka selenggarakan ke dalam sistem. Pengguna dapat dengan mudah mengakses seluruh informasi acara, mulai dari deskripsi acara, jadwal pelaksanaan, hingga tautan pendaftaran dan detail penting lainnya.

## Fitur Utama

### Admin
- Mengelola seluruh sistem
- Memverifikasi dan menyetujui pendaftaran event organizer
- Mengelola data pengguna
- Mengawasi aktivitas di platform
- Dashboard khusus untuk memantau event, organizer, dan aktivitas pengguna

### Event Organizer
- Mengelola acara yang mereka buat (CRUD event)
- Mengatur detail turnamen atau acara
- Melihat dan mengelola daftar peserta yang mendaftar
- Dashboard khusus untuk melihat statistik event

### User
- Melihat daftar event dan turnamen yang tersedia
- Mendaftar ke event yang diminati
- Menyimpan event ke dalam daftar favorit
- Memberikan rating dan ulasan terhadap event yang telah diikuti

## Teknologi

- Framework: Laravel 12
- Database: SQLite (untuk pengembangan)
- Frontend: Bootstrap 5, Bootstrap Icons
- Autentikasi: Laravel Breeze (disesuaikan)

## Progress Pengembangan

### Backend
1. Struktur database dengan migrations:
   - `users` dengan role dan status
   - `event_categories` untuk kategori event
   - `events` untuk informasi event
   - `event_participants` untuk peserta event
   - `event_favorites` untuk event favorit user
   - `event_ratings` untuk rating dan ulasan event

2. Model Eloquent dengan relasi:
   - User dengan relasi ke events, participants, favorites, ratings
   - Event dengan relasi ke category, organizer, participants, favorites, ratings
   - EventCategory dengan relasi ke events
   - EventParticipant dengan relasi ke event dan user
   - EventFavorite dengan relasi ke event dan user
   - EventRating dengan relasi ke event dan user

3. Controller:
   - `AuthController` untuk autentikasi (login, register, logout)
   - `EventController` untuk menampilkan daftar event dan detail event
   - `UserController` untuk dashboard user dan fungsi terkait user
   - `EventOrganizerController` untuk dashboard organizer dan manajemen event
   - `AdminController` untuk dashboard admin dan manajemen sistem

4. Middleware:
   - `RoleMiddleware` untuk mengatur akses berdasarkan role (admin, event_organizer, user)

5. Routing:
   - Route publik untuk halaman welcome dan detail event
   - Route auth untuk login dan register
   - Route user untuk dashboard dan fungsi terkait user
   - Route organizer untuk dashboard dan manajemen event
   - Route admin untuk dashboard dan manajemen sistem

### Frontend
1. Layout utama (`layouts/app.blade.php`):
   - Navbar dengan menu yang berbeda untuk setiap role
   - Footer dengan informasi TemuEvent
   - Area untuk menampilkan pesan alert

2. Halaman utama:
   - Welcome page yang menampilkan daftar event dalam bentuk card
   - Halaman detail event dengan informasi lengkap dan fitur untuk mendaftar dan menambahkan ke favorit

3. Halaman autentikasi:
   - Halaman login dengan form login
   - Halaman register dengan form pendaftaran

4. Dashboard:
   - Dashboard user dengan statistik dan daftar event yang diikuti
   - Dashboard event organizer dengan statistik dan manajemen event
   - Dashboard admin dengan statistik dan manajemen sistem

5. Form pembuatan event untuk event organizer

6. CSS dan JavaScript:
   - File CSS untuk styling aplikasi
   - File JavaScript untuk interaktivitas (AJAX untuk pendaftaran event dan favorit)

## Akun Default

### Admin
- Email: admin@temuevent.com
- Password: password

### Event Organizer
- Email: organizer@temuevent.com
- Password: password

### User
- Email: user@temuevent.com
- Password: password

## Langkah Selanjutnya

1. Melengkapi fitur-fitur yang belum diimplementasikan:
   - Fitur pencarian dan filter event
   - Fitur manajemen profil user dan event organizer
   - Fitur approval/rejection untuk event organizer dan event oleh admin
   - Fitur analytics untuk admin

2. Meningkatkan UI/UX:
   - Menambahkan lebih banyak komponen UI
   - Meningkatkan responsivitas untuk perangkat mobile
   - Menambahkan animasi dan transisi

3. Optimisasi:
   - Optimisasi performa
   - Optimisasi database query
   - Caching

4. Testing:
   - Unit testing
   - Feature testing
   - Integration testing

5. Deployment:
   - Persiapan untuk deployment ke server produksi
   - Konfigurasi environment produksi
   - Setup CI/CD