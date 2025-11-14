# Final Project: RuangDiskusi

**RuangDiskusi** adalah aplikasi forum tanya jawab yang dibuat untuk Tugas final project MagangHub di PT Kreasi Hexa Indonesia. Aplikasi ini memungkinkan pengguna untuk mendaftar, membuat pertanyaan (lengkap dengan gambar dan *tags*), serta memberikan jawaban atas pertanyaan pengguna lain.

Aplikasi ini dibangun menggunakan **Laravel 11**, **Tailwind CSS** (via Laravel Breeze), dan **MySQL**.
Aplikasi ini di-deploy dan di-host secara *online* menggunakan **Railway**.

---

## 🚀 Link Aplikasi

* **Link Deploy (Railway):** [https://ruangdiskusi-production.up.railway.app/]
* **Link Video Demo:** `[https://drive.google.com/drive/folders/1tx9kyLXJGAAsMmRSunA7Pk6XpxFaiwP1?usp=sharing]`

---

## 🏛️ Entity Relationship Diagram (ERD)

Desain database aplikasi ini mencakup relasi *One-to-Many* (misal: `User` ke `Questions`) dan *Many-to-Many* (antara `Questions` dan `Tags` menggunakan tabel *polymorphic* `taggables`).

![(https://drive.google.com/file/d/16koOr7Rjoc_tmwmazY2xxiN5ua_oUurC/view?usp=sharing)]

---

## 💻 Fitur Utama

Aplikasi ini memenuhi semua *requirement* Pilihan 2, termasuk:

* **Autentikasi User** (Login & Register).
* **Dashboard Kustom** dengan statistik personal (`Total Pertanyaan Saya`, `Total Jawaban Saya`) dan "Aksi Cepat".
* **CRUD Kategori** (User dapat menambah, mengedit, dan menghapus kategori).
* **CRUD Pertanyaan** (User dapat membuat pertanyaan dan hanya bisa mengedit/menghapus pertanyaan milik sendiri).
* **CRUD Jawaban** (User dapat memberi jawaban dan hanya bisa mengedit/menghapus jawaban milik sendiri).
* **Update Profil User** (User dapat mengubah nama, email, serta biodata, umur, dan alamat).
* **Upload Gambar** untuk Pertanyaan.
* **Filter Pertanyaan** berdasarkan Kategori di halaman Forum.
* **Navigasi** yang jelas antara Dashboard dan Forum.

## 📚 3 Library/Package yang Digunakan

1.  **SweetAlert2:** Digunakan untuk memberikan notifikasi *pop-up* yang modern saat akan menghapus data (Kategori, Pertanyaan, Jawaban).
2.  **Datatables.net:** Diterapkan pada tabel "Kelola Kategori" untuk menyediakan fitur Pencarian, Sortir, dan Paginasi secara instan.
3.  **spatie/laravel-tags:** Digunakan untuk mengimplementasikan fungsionalitas *tagging* (relasi Many-to-Many) pada setiap Pertanyaan.

## 🧪 Test-Driven Development (TDD)

Proyek ini juga mengimplementasikan tes fitur (Feature Tests) menggunakan PHPUnit untuk memastikan fungsionalitas inti berjalan sesuai harapan. Tes yang dibuat mencakup:

* **`AuthenticationTest`:** Memastikan user bisa *login* dengan kredensial yang benar dan gagal dengan kredensial yang salah.
* **`ProfileTest`:** Memastikan update profil (termasuk *field* custom `biodata`, `umur`, `alamat`) berjalan sesuai siklus TDD (Red-Green-Refactor).
* **`AnswerTest`:** Memastikan user bisa membuat jawaban dan tidak bisa menghapus jawaban milik user lain (tes otorisasi).

## 🏃 Cara Menjalankan Proyek Secara Lokal

1.  Clone repository ini:
    ```bash
    git clone [https://github.com/arsitanrfzh/RuangDiskusi.git](https://github.com/arsitanrfzh/RuangDiskusi.git)
    cd RuangDiskusi
    ```
2.  Salin file `.env`:
    ```bash
    cp .env.example .env
    ```
3.  Install dependencies:
    ```bash
    composer install
    npm install
    ```
4.  Jalankan `npm run build` (untuk aset frontend):
    ```bash
    npm run build
    ```
5.  Generate kunci aplikasi:
    ```bash
    php artisan key:generate
    ```
6.  Atur `.env` Anda (terutama `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) agar sesuai dengan database MySQL lokal Anda.
7.  Jalankan migrasi (membuat semua tabel):
    ```bash
    php artisan migrate
    ```
8.  Buat *link* storage (untuk upload gambar):
    ```bash
    php artisan storage:link
    ```
9.  Jalankan server:
    ```bash
    php artisan serve
    ```