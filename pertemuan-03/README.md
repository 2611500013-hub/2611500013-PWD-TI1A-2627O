# Pertemuan 3 - Formulir HTML dan CSS Dasar

## Baseline

- Menggunakan hasil P2 sebagai dasar pengembangan P3.
- Menyalin `index.html` dan `img/foto-profil.jpg` ke `pertemuan-03/`.

## Implementasi Formulir

- Elemen form yang digunakan: `<form>`, `<label>`, `<input>`, `<select>`, `<option>`, `<textarea>`, dan `<button>`.
- Tipe input yang digunakan: `text`, `email`, `number`, `date`, `radio`, dan `checkbox`.
- Atribut validasi yang digunakan: `required`, `minlength`, `maxlength`, `min`, dan `max`. Validasi bawaan juga diterapkan melalui tipe input `email` dan `number`.

## Pengujian GET dan POST

- Hasil pengujian GET: Form menggunakan `method="get"`. Saat dikirim, nilai formulir ditambahkan ke query string URL; data tidak disimpan ke server.
- Contoh URL encoding yang ditemukan: Spasi pada nilai nama seperti `Ricko Ferdian` dikirim sebagai `Ricko+Ferdian`. Karakter khusus seperti `&` dikodekan menjadi `%26`.
- Hasil pengujian POST: Belum diterapkan atau diuji. Form saat ini menggunakan GET dan belum memiliki endpoint untuk memproses data POST.

## CSS Dasar

- Selector elemen: `h2`, `h3`, `p`, dan `ol` sebagai selector turunan dari `#about` atau `#contact`.
- Selector class: `.form-group` (digunakan pada kelompok input). `.input-form` juga didefinisikan, tetapi belum dipasang pada elemen HTML.
- Selector ID: `#about` dan `#contact`, termasuk selector turunannya seperti `#contact button`.
- Properti CSS dasar yang digunakan: `background-color`, `border`, `padding`, `margin`, `font-family`, `color`, `font-size`, `font-weight`, dan `border-bottom`.

## Pengujian dan Perbaikan

- Galat yang ditemukan: Penutup dokumen HTML (`</main>`, `</body>`, dan `</html>`) sempat tidak ada setelah bagian formulir.
- Penyebab galat: Struktur dokumen terpotong sebelum elemen penutup utama ditulis.
- Perbaikan yang dilakukan: Menambahkan kembali elemen penutup dokumen dan memastikan bagian formulir berada di dalam `<main>`.
- Hasil pengujian ulang: Struktur section dan main seimbang, form berada sebelum `</body>`, dokumen berakhir dengan `</html>`, dan file gambar tersedia.

## GitHub Pages

URL: https://2611500013-hub.github.io/2611500013-PWD-TI1A-2627O/pertemuan-03/