# TemuEvent - Platform Manajemen Event Indonesia

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang TemuEvent

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

## Instalasi

1. Clone repository
   ```bash
   git clone https://github.com/username/TemuEvent.git
   cd TemuEvent
   ```

2. Install dependencies
   ```bash
   composer install
   npm install
   ```

3. Salin file environment dan konfigurasi
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Jalankan migrasi dan seeding database
   ```bash
   php artisan migrate:fresh --seed
   ```

5. Jalankan server pengembangan
   ```bash
   php artisan serve
   ```

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

## Kontribusi

Kontribusi sangat diterima. Silakan buat branch untuk fitur baru dan submit pull request.

## Lisensi

Proyek ini dilisensikan di bawah MIT License - lihat file [LICENSE](LICENSE) untuk detail.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive database ORM (https://laravel.com/docs/eloquent).
- Database agnostic schema migrations (https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out Laravel Learn, where you will be guided through building a modern Laravel application.

If you don't feel like reading, Laracasts can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel Partners program.

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the Laravel documentation.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the Code of Conduct.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the MIT license.
