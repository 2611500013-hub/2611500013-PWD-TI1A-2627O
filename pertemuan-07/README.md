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

## P7 - Validasi Formulir, Session, dan Pola PRG

### Dokumentasi Perubahan
Formulir kontak pada `index.php` mengirim data menggunakan metode `POST`. PHP mengambil data yang dikirim, memangkas spasi pada isian teks, dan memastikan pilihan minat berbentuk array. Data divalidasi di sisi peladen untuk memeriksa:

- Kelengkapan nama, email, semester, tanggal kunjungan, jenis pesan, program studi, pesan, dan minimal satu topik minat.
- Semester berupa bilangan bulat dalam rentang 1 sampai 14.
- Format alamat email.
- Nilai jenis pesan (`pertanyaan` atau `saran`), program studi (`SI` atau `TI`), dan topik minat (`HTML` atau `CSS`) agar hanya pilihan yang diizinkan diterima.

Sesudah validasi, nilai isian dan pesan kesalahan disimpan ke session. Peladen lalu mengalihkan pengguna ke `index.php` dengan metode GET (pola Post/Redirect/Get atau PRG). Setelah redirect, pesan kesalahan ditampilkan jika ada dan data yang diterima ditampilkan dengan `htmlspecialchars` untuk mencegah data masukan diperlakukan sebagai HTML. Nilai tanggal memakai tanggal hari ini sebagai nilai awal jika belum ada di session.

Di `script.js`, validasi sisi klien memeriksa panjang nama, format email, rentang semester, minimal satu topik minat (mendukung nama checkbox `minat` dan `minat[]`), serta kelengkapan formulir. Jika validasi lolos, formulir dikirim ke peladen PHP untuk divalidasi kembali.

### Uji Coba dan Hasil
- PHP 8.3.33, `php -l pertemuan-07\index.php`: **lulus**, tidak ditemukan galat sintaks.
- Permintaan GET ke halaman formulir lokal: **lulus**, server mengembalikan HTTP 200.
- Pengiriman POST dengan data kosong/tidak valid: **lulus**, halaman dialihkan kembali dan pesan kesalahan untuk kolom wajib, email, dan semester muncul.
- Pengiriman POST dengan data valid, termasuk topik `HTML`: **lulus**, setelah redirect data formulir tampil pada bagian “Data yang Diterima Peladen”.
- Pemeriksaan sintaks JavaScript dengan `node --check`: **tidak dijalankan**, Node.js tidak tersedia di lingkungan pengujian.
- Pengujian interaksi visual dan perilaku formulir di browser: **belum dilakukan**.
