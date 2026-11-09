# Pertemuan 09 — Salinan Artefak dan Fungsi `bersihkan()`

Folder ini dibuat dengan menyalin seluruh artefak dari `pertemuan-08` sebagai
dasar materi Pertemuan 09. Setelah penyalinan, fungsi `bersihkan()` dipindahkan
dari `index.php` ke file terpisah bernama `fungsi.php`.

## Perubahan pada Pertemuan 09

- Semua file dan aset dari `pertemuan-08` disalin ke folder `pertemuan-09`.
- Fungsi `bersihkan()` dipisahkan ke `fungsi.php`, agar fungsi dapat dirawat
  terpisah dari kode halaman.
- `index.php` memuat definisi fungsi melalui
  `require_once __DIR__ . "/fungsi.php";` sebelum fungsi digunakan.
- Fungsi `bersihkan()` dipakai saat menampilkan data formulir agar masukan
  pengguna tidak diperlakukan sebagai markup HTML. Fungsi ini bukan informasi
  profil, sehingga tidak ditampilkan sebagai baris tambahan pada bagian profil.

## File utama

- `index.php` — halaman profil dan formulir; memuat `fungsi.php` dan memanggil
  `bersihkan()` saat menampilkan nilai. Data formulir kontak disimpan bersama
  dalam array `$_SESSION["data_kontak"]`.
- `fungsi.php` — definisi fungsi `bersihkan()`.
- `indexGet.php` — halaman latihan formulir dengan metode GET.
- `script.js` — navigasi responsif dan validasi formulir sisi klien.
- `style.css` — gaya dan tata letak halaman.
- `img/foto-profil.jpg` — gambar profil.

## Cara kerja `bersihkan()`

```php
function bersihkan($data): string
{
    if (!is_scalar($data)) {
        return "";
    }

    $data = trim((string) $data);
    $data = stripslashes($data);

    return htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
```

Fungsi memeriksa agar nilai yang diterima berupa scalar, lalu mengubahnya menjadi
string, merapikan spasi di awal/akhir dengan `trim()`, menghapus backslash
dengan `stripslashes()`, dan melakukan escaping untuk konteks HTML dengan
`htmlspecialchars()`. `ENT_QUOTES` meng-escape tanda kutip tunggal dan ganda,
sedangkan `ENT_SUBSTITUTE` menangani byte UTF-8 yang tidak valid.

Contoh penggunaan untuk menampilkan nilai formulir:

```php
<?= bersihkan($_SESSION["data_kontak"]["nama"] ?? "") ?>
```

Misalnya nilai yang diterima adalah:

```text
<script>alert('hai');</script>
```

Setelah diproses, karakter khusus HTML di-escape sehingga browser menampilkan
tag tersebut sebagai teks dan tidak menjalankan JavaScript. Fungsi digunakan
saat menghasilkan output HTML, sedangkan data session disimpan tanpa escaping
agar tidak terjadi escaping ganda.

## Menjalankan proyek

Jalankan dengan server PHP, misalnya Apache melalui Laragon, lalu buka
`pertemuan-09/index.php` di browser.
