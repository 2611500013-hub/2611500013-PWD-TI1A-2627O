<?php
session_start();
$nama = trim((string) ($_POST['nama'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$semesterForm = trim((string) ($_POST['semester'] ?? ''));
$jenisPesan = trim((string) ($_POST['jenis_pesan'] ?? ''));
$prodi = trim((string) ($_POST['prodi'] ?? ''));
$pesan = trim((string) ($_POST['pesan'] ?? ''));
$tanggal = trim((string) ($_POST['tanggal'] ?? ''));
$minat = is_array($_POST['minat'] ?? null) ? $_POST['minat'] : []; // default array kosong jika tidak memilih
$pesanKesalahan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Cek Kelengkapan (Wajib Diisi)
    if ($nama === '') { $pesanKesalahan .= 'Nama lengkap wajib diisi. '; }
    if ($email === '') { $pesanKesalahan .= 'Email wajib diisi. '; }
    if ($semesterForm === '') { $pesanKesalahan .= 'Semester wajib diisi. '; }
    if ($tanggal === '') { $pesanKesalahan .= 'Tanggal kunjungan wajib diisi. '; }
    if ($jenisPesan === '') { $pesanKesalahan .= 'Jenis pesan wajib dipilih. '; }
    if ($prodi === '') { $pesanKesalahan .= 'Program studi wajib dipilih. '; }
    if ($pesan === '') { $pesanKesalahan .= 'Pesan wajib diisi. '; }
    if (empty($minat)) { $pesanKesalahan .= 'Minat wajib dipilih minimal satu. '; }

    // 2. Validasi Format Angka Semester (Harus 1 - 14)
    if ($semesterForm !== '') {
        $semesterValid = filter_var($semesterForm, FILTER_VALIDATE_INT);
        if ($semesterValid === false || $semesterValid < 1 || $semesterValid > 14) {
            $pesanKesalahan .= 'Semester harus berupa bilangan bulat antara 1 dan 14. ';
        }
    }

    // 3. Validasi Format Email
    if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $pesanKesalahan .= 'Format email tidak valid. ';
    }

    // 4. Validasi Keamanan Pilihan (Mencegah Manipulasi Value)
    if (!in_array($jenisPesan, ['pertanyaan', 'saran'], true)) { $pesanKesalahan .= 'Jenis pesan tidak valid. '; }
    if (!in_array($prodi, ['SI', 'TI'], true)) { $pesanKesalahan .= 'Program studi tidak valid. '; }

    $minatDiizinkan = ['HTML', 'CSS'];
    foreach ($minat as $topik) {
        if (!in_array($topik, $minatDiizinkan, true)) {
            $pesanKesalahan .= 'Pilihan topik tidak valid. ';
            break;
        }
    }
}

// P7: Terapkan Pola PRG setelah validasi selesai dijalankan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['pesanKesalahan'] = $pesanKesalahan;
    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    $_SESSION['semester'] = $semesterForm;
    $_SESSION['tanggal'] = $tanggal;
    $_SESSION['jenis_pesan'] = $jenisPesan;
    $_SESSION['prodi'] = $prodi;
    $_SESSION['minat'] = $minat;
    $_SESSION['pesan'] = $pesan;

    // Alihkan halaman ke dirinya sendiri dengan metode GET
    header('Location: index.php');
    exit;
}
// ... kode inisialisasi variabel bawahnya ...
// Deklarasi Variabel & Tipe Data
$nim = "2611500013";                         // String
$namaMahasiswa = "Ricko Ferdian"; // String
$programStudi = "TI";                         // String
$tahunAkademik = "2026/2027";                 // String
$semester = 1;                                // Integer
$ipk = 0.0;                                  // Float
$statusAktif = true;                          // Boolean
$catatanTambahan = null;                      // NULL

// Deklarasi Konstanta
const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "RickoFerdian";

// Kategori Semester (if-elseif-else)
if ($semester < 3) {
    $keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
    $keteranganSemester = "Semester menengah";
} else {
    $keteranganSemester = "Semester akhir";
}

// Fokus Program Studi (switch-case)
switch ($programStudi) {
    case "SI":
        $namaProdi = "Sistem Informasi";
        $fokusProgramStudi = "Sistem informasi dan proses bisnis";
        break;
    case "TI":
        $namaProdi = "Teknik Informatika";
        $fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak";
        break;
    default:
        $namaProdi = "Belum ditentukan";
        $fokusProgramStudi = "Belum ditentukan";
}

$sisaSemester = max(0, 14 - $semester);
$statusSemester = $semester >= 1 && $semester <= 14
    ? "Dalam rentang 1-14"
    : "Di luar rentang 1-14";

// Mengambil data session setelah halaman dialihkan (Redirected GET)
$pesanKesalahan = $_SESSION['pesanKesalahan'] ?? '';
$nama = $_SESSION['nama'] ?? '';
$email = $_SESSION['email'] ?? '';
$semesterForm = $_SESSION['semester'] ?? '';
$tanggal = $_SESSION['tanggal'] ?? date("Y-m-d");
$jenisPesan = $_SESSION['jenis_pesan'] ?? '';
$prodi = $_SESSION['prodi'] ?? '';
$minat = $_SESSION['minat'] ?? [];
$pesan = $_SESSION['pesan'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Profil Mahasiswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1>Profil Mahasiswa</h1>
<nav>
<button
 class="nav-toggle"
 id="navToggle"
 type="button"
 aria-label="Buka navigasi"
 aria-controls="navMenu"
 aria-expanded="false"
>
 &#9776;
</button>
<ul id="navMenu">
<li><a href="#home">Beranda</a></li>
<li><a href="#about">Tentang</a></li>
<li><a href="#contact">Kontak</a></li>
</ul>
</nav>
</header>
<main>
<section id="home">
<h2>Selamat Datang</h2>
<p>Halo, saya <strong><?php echo $namaMahasiswa; ?></strong>. 
Saya sedang mempelajari matakuliah <strong><?php print NAMA_MATA_KULIAH; ?></strong> 
pada tahun akademik <?php echo $tahunAkademik; ?>.</p>
<img src="img/foto-profil.jpg" alt="foto profil Nama Mahasiswa">
</section>
<section id="about">
<h2>Tentang Saya</h2>
<article>
<h3>Profil Singkat</h3>
<p>Program Studi: <?php echo $namaProdi . " (" . $programStudi . ")"; ?></p>
<p>Fokus program studi: <?php echo $fokusProgramStudi; ?></p>
<p>Status mahasiswa: <?php echo $statusAktif ? "Aktif" : "Tidak aktif"; ?></p>
<p>Semester: <?php echo $semester . " (" . $keteranganSemester . ")"; ?></p>
<p>Sisa semester hingga batas: <?php echo $sisaSemester; ?></p>
<p>Pemeriksaan rentang semester: <?php echo $statusSemester; ?></p>
<p>IPK: <?php echo number_format($ipk, 2, ',', '.'); ?></p>
<p>Catatan tambahan: <?php echo $catatanTambahan === null ? "Belum ada" : $catatanTambahan; ?></p>
<h3>Target Belajar (Perulangan for)</h3>
<ol>
<?php
for ($i = 1; $i <= 5; $i++) {
    echo "<li>Target belajar ke-" . $i . ": ";
    switch ($i) {
        case 1: echo "Memahami sintaks dasar PHP."; break;
        case 2: echo "Menggunakan variabel dan konstanta."; break;
        case 3: echo "Menerapkan operator dan percabangan."; break;
        case 4: echo "Menggunakan perulangan for dan while."; break;
        default: echo "Belum dipetakan"; break;
    }
    echo "</li>";
}
?>
</ol>
<h3>Semester (Perulangan while):</h3>
<ol>
<?php
$nomorSemester = 1;
while ($nomorSemester <= 1) {
    echo "<li>Semester " . $nomorSemester . "</li>";
    $nomorSemester++;
}
?>
</ol>
</article>
</section>
<section id="contact">
    <h2>Kontak</h2>

    <?php if ($pesanKesalahan !== ''): ?>
        <p class="form-feedback-error">
            <?= htmlspecialchars($pesanKesalahan, ENT_QUOTES, 'UTF-8') ?>
        </p>
        <?php unset($_SESSION['pesanKesalahan']); ?>
    <?php endif; ?>

    <p>Kunjungi <a href="https://github.com/<?php echo PROFIL_GITHUB; ?>" target="_blank" rel="noopener noreferrer">profil GitHub saya</a>.</p>

    <form id="contactForm" action="index.php" method="post" novalidate>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label><br>
            <input
                type="text"
                class="input-form"
                id="nama"
                name="nama"
                placeholder="Masukkan nama lengkap"
                minlength="3"
                maxlength="50"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label><br>
            <input
                type="email"
                class="input-form"
                id="email"
                name="email"
                placeholder="nama@email.com"
                required
            >
        </div>

        <div class="form-group">
            <label for="semester">Semester</label><br>
            <input
                type="number"
                class="input-form"
                id="semester"
                name="semester"
                min="1"
                max="14"
                required
            >
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal Kunjungan</label><br>
            <input
                type="date"
                class="input-form"
                id="tanggal"
                name="tanggal"
                required
            >
        </div>

        <div class="form-group">
            <p>Jenis Pesan</p>

            <input
                type="radio"
                id="pertanyaan"
                name="jenis_pesan"
                value="pertanyaan"
                required
            >
            <label for="pertanyaan">Pertanyaan</label>

            <input
                type="radio"
                id="saran"
                name="jenis_pesan"
                value="saran"
            >
            <label for="saran">Saran</label>
        </div>

        <div class="form-group">
            <p>Topik yang Diminati</p>

            <input
                type="checkbox"
                id="minat-html"
                name="minat[]"
                value="HTML"
            >
            <label for="minat-html">HTML</label>

            <input
                type="checkbox"
                id="minat-css"
                name="minat[]"
                value="CSS"
            >
            <label for="minat-css">CSS</label>
        </div>

        <div class="form-group">
            <label for="prodi">Program Studi</label><br>

            <select class="input-form" id="prodi" name="prodi" required>
                <option value="">-- Pilih Program Studi --</option>
                <option value="SI">Sistem Informasi</option>
                <option value="TI">Teknik Informatika</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pesan">Pesan</label><br>

            <textarea
                class="input-form"
                id="pesan"
                name="pesan"
                maxlength="300"
                placeholder="Tulis pesan Anda"
                required
            ></textarea>
        </div>

        <div id="formFeedback" class="form-feedback"></div>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>

    </form>

    <?php if (!empty($nama)): ?>
        <h3>Data yang Diterima Peladen</h3>
        <p>Nama: <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Email: <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Semester: <?= htmlspecialchars($semesterForm, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Tanggal kunjungan: <?= htmlspecialchars($tanggal, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Jenis pesan: <?= htmlspecialchars($jenisPesan, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Program studi: <?= htmlspecialchars($prodi, ENT_QUOTES, 'UTF-8') ?></p>

        <p>Minat:</p>
        <?php if (is_array($minat) && count($minat) > 0): ?>
            <ul>
                <?php foreach ($minat as $topik): ?>
                    <li><?= htmlspecialchars((string) $topik, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Tidak ada minat yang dipilih.</p>
        <?php endif; ?>

        <p>Pesan:</p>
        <p><?= nl2br(htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8')) ?></p>
    <?php endif; ?>
</section>
</main>
<footer>
<p>&copy; <?= date("Y") ?> <?php echo $namaMahasiswa; ?> [<?= $nim ?>]</p>
</footer>
<script src="script.js"></script>
</body>
</html>