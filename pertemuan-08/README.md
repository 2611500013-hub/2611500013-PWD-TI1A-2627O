# Pertemuan 08 — Profil Mahasiswa dan Rencana Kegiatan

Halaman profil mahasiswa berbasis PHP yang menggabungkan navigasi responsif,
formulir kontak, dan fitur untuk merencanakan kegiatan mahasiswa. Data formulir
diproses di sisi server dan disimpan sementara di session.

## Ringkasan fitur

- **Navigasi halaman**: tautan Beranda, Tentang, Rencana Kegiatan, dan Kontak
  berpindah ke section terkait. Tombol navigasi responsif digunakan pada layar
  kecil.
- **Profil mahasiswa**: menampilkan informasi akademik, target belajar dengan
  perulangan `for`, serta daftar semester dengan perulangan `while`.
- **Formulir kontak**: memeriksa isian di JavaScript, mengirim data dengan
  metode POST, menyimpan hasilnya di session, dan menampilkannya kembali pada
  halaman.
- **Formulir Rencana Kegiatan Mahasiswa**: menerima NIM pengusul, nama,
  kategori, dosen penanggung jawab/pembimbing, target peserta,
  tanggal, lokasi, dan deskripsi
  kegiatan. NIM harus terdiri dari 10 digit. Pilihan kategori mencakup Akademik,
  Non-Akademik, Organisasi, dan Pemahaman Tentang Teknik Informatika; pilihan
  dosen mencakup Yohanes Setiawan, Chandra Kirana, dan Dr. Ellya Helmud.
- **Validasi kegiatan**: JavaScript mencegah pengiriman jika ada kolom kosong
  atau hanya berisi spasi. PHP juga memvalidasi isian, kategori yang diizinkan,
  dan format tanggal di server.
- **Konfirmasi pengiriman**: data kegiatan yang valid disimpan di session dan
  ditampilkan dalam kartu ringkasan. Isian yang tidak valid menampilkan pesan
  kesalahan.
- **Keamanan tampilan**: nilai session di-escape dengan `htmlspecialchars`
  sebelum ditampilkan, dan deskripsi mendukung baris baru dengan `nl2br`.
- **Post-Redirect-Get (PRG)**: setelah POST, pengguna diarahkan kembali ke
  section formulir sehingga refresh halaman tidak mengirim ulang POST.

## Alur formulir rencana kegiatan

1. Pengguna membuka menu **Rencana Kegiatan** dan mengisi semua kolom.
2. `script.js` memeriksa kolom kosong atau yang hanya berisi spasi sebelum
   formulir dikirim.
3. `index.php` memeriksa kembali data di server. Kategori harus termasuk dalam
   daftar pilihan dan tanggal harus sesuai format `YYYY-MM-DD`.
4. Jika data valid, detail kegiatan disimpan pada `$_SESSION["data_kegiatan"]`
   dan status sukses dicatat di session. Jika tidak valid, pesan error disimpan.
5. PHP mengarahkan pengguna kembali ke `#rencana-kegiatan`, lalu halaman
   menampilkan kartu ringkasan atau notifikasi kesalahan.

## Berkas utama

- `index.php` — halaman profil, form kontak dan kegiatan, pemrosesan POST,
  validasi server, serta tampilan hasil dari session.
- `script.js` — navigasi responsif dan validasi JavaScript untuk kedua formulir.
- `style.css` — tata letak halaman dan gaya responsif, termasuk kartu hasil
  rencana kegiatan.
- `indexGet.php` — halaman latihan pengiriman formulir menggunakan metode GET.
- `img/foto-profil.jpg` — gambar profil yang digunakan di halaman.

## Menjalankan proyek

Jalankan proyek menggunakan server PHP, misalnya Apache melalui Laragon, lalu
buka halaman `pertemuan-08/index.php` di browser.

## Catatan pembelajaran P7

Pada P7, folder P6 digunakan sebagai baseline. Latihan mencakup pengujian
halaman, penggunaan superglobal `$_GET` dan `$_POST`, serta perbedaan metode
GET dan POST. Fitur formulir pada halaman ini dikembangkan dengan pemrosesan
POST, session, validasi, dan pola PRG.
