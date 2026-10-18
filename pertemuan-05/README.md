# P5 - JavaScript Dasar, DOM, Event, dan Validasi Sisi Klien

## Deskripsi
Dokumentasi pengembangan halaman web P5, meliputi JavaScript, DOM, event listener, interaksi navigasi, dan validasi formulir sisi klien.

## Fitur dan Pengembangan
- Baseline P5: menyalin dan memverifikasi artefak dari Pertemuan 4.
- Hamburger menu: menerapkan interaksi buka-tutup navigasi menggunakan DOM dan `classList.toggle()`.
- Validasi formulir: memvalidasi kolom nama, email, dan semester di sisi klien sebelum formulir diproses.

## Pengujian
- Navigasi: pada layar seluler, tombol hamburger menampilkan atau menyembunyikan tautan navigasi dalam susunan kolom.
- Validasi nama: nama dengan 2 karakter menampilkan pesan galat; panjang yang diterima adalah 3 sampai 50 karakter.
- Validasi email: format tanpa `@` atau domain ditolak.
- Validasi semester: angka di luar rentang 1 sampai 14 menampilkan pesan galat.
- Interaksi dinamis: pesan feedback dihapus saat pengguna mengetik kembali atau menekan tombol reset.
- Kolom wajib lainnya tetap diperiksa menggunakan validasi bawaan browser.

## Riwayat Pengembangan
- Menyiapkan baseline P5 dari artefak P4.
- Menambahkan tombol navigasi responsif dan logika hamburger menu.
- Menerapkan pencegahan submit bawaan, validasi formulir, dan feedback untuk pengguna.
