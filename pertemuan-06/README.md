# P6 - Variabel, Tipe Data, Operator, dan Struktur Kontrol PHP

## Deskripsi
Dokumentasi halaman profil mahasiswa pada Pertemuan 6. Halaman menggunakan PHP untuk menampilkan data, memilih keterangan program studi dan semester, serta mempraktikkan perulangan `for` dan `while`.

## Galat yang Ditemukan dan Perbaikan
- **Program studi tidak sesuai dengan identitas kelompok.** Nilai `$programStudi` sebelumnya `SI`, sehingga `switch` menampilkan Sistem Informasi, padahal identitas mahasiswa berada di kelompok TI1A. Nilai diperbaiki menjadi `TI`; halaman sekarang menampilkan Teknik Informatika beserta fokus program studinya.
- **Daftar semester tidak mencerminkan semester yang sedang dijalani.** Perulangan `while` sebelumnya menampilkan semester 1 sampai 3, sementara nilai `$semester` adalah 1. Batas perulangan disesuaikan agar daftar menampilkan semester 1 saja.

## Hasil Pengujian
- Pemeriksaan sintaks menggunakan PHP 8.3.33 (`php -l pertemuan-06\index.php`): **lulus**, tidak ditemukan galat sintaks.
- Eksekusi halaman melalui PHP CLI: **lulus**. Output memuat `Teknik Informatika (TI)`, `Sisa semester hingga batas: 13`, dan satu entri `Semester 1`.
- Pemeriksaan tampilan visual, navigasi, dan validasi formulir di browser: **belum dilakukan**.
