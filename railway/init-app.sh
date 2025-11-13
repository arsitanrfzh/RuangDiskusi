#!/bin/bash

# Hentikan script jika ada 1 perintah yg gagal
set -e

# 1. Bersihkan semua cache
php artisan optimize:clear

# 2. Jalankan migrasi (membuat semua tabel)
php artisan migrate --force

# 3. Buat link storage (agar gambar tampil)
php artisan storage:link