# P6 - Variabel, Tipe Data, Operator, dan Struktur Kontrol PHP

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

#### Skenario Uji Formulir

| Skenario | Data uji | Hasil yang diharapkan | Hasil |
|---|---|---|---|
| Membuka halaman | Permintaan GET ke `index.php` | Halaman formulir tampil dengan HTTP 200 | Lulus |
| Validasi data tidak lengkap | POST tanpa nama, tanggal, pilihan wajib, atau pesan | Setelah redirect, pesan kesalahan kelengkapan ditampilkan | Lulus |
| Validasi format email | Email `bad` | Pesan format email tidak valid ditampilkan setelah redirect | Lulus |
| Validasi semester | Semester `15` | Pesan bahwa semester harus berupa bilangan bulat 1-14 ditampilkan | Lulus |
| Pengiriman data valid | Nama, email valid, semester `1`, tanggal, pilihan, minat `HTML`, dan pesan | Setelah redirect, data formulir tampil dengan aman pada bagian data yang diterima | Lulus |

Skenario HTTP dijalankan menggunakan server PHP lokal dan sesi yang terpisah untuk masing-masing pengiriman. Validasi sisi klien di browser belum diuji secara interaktif; validasi peladen tetap dijalankan sebagai pemeriksaan utama untuk setiap POST.