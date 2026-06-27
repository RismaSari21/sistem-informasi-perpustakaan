# Sistem Informasi Perpustakaan

Aplikasi berbasis **Laravel 12** untuk mengelola data buku, peminjaman, dan pengembalian buku secara digital.

## Anggota Tim

| Nama | Peran | GitHub |
|------|-------|--------|
| **Triyas Nurlita Nurul Adha** | Ketua Tim, Dashboard, CRUD Buku | https://github.com/triyasnur |
| **Risma Sari** | CRUD Peminjaman Buku | https://github.com/username-risma |
| **Florentina Kewa Lobemato** | CRUD Pengembalian Buku | https://github.com/username-florentina |

## Fitur

- Login & Register
- Dashboard
- CRUD Data Buku
- CRUD Peminjaman Buku
- CRUD Pengembalian Buku
- Profil Pengguna

## Teknologi

- Laravel 12
- PHP 8+
- SQLite
- Tailwind CSS
- Vite

## Instalasi

```bash
git clone https://github.com/triyasnur/sistem-informasi-perpustakaan.git

cd sistem-informasi-perpustakaan

composer install
npm install

cp .env.example .env
php artisan key:generate
php artisan migrate --seed

npm run dev
php artisan serve
