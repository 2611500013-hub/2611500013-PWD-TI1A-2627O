<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// P7: Memproses data formulir dan menyimpannya ke dalam session.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (($_POST["action"] ?? "") === "submit_rencana") {
		$nimMahasiswa = trim((string) ($_POST["nim_mahasiswa"] ?? ""));
		$anggaranKegiatan = trim((string) ($_POST["anggaran_kegiatan"] ?? ""));
		$namaKegiatan = trim((string) ($_POST["nama_kegiatan"] ?? ""));
		$kategoriKegiatan = trim((string) ($_POST["kategori_kegiatan"] ?? ""));
		$dosenPembimbing = trim((string) ($_POST["dosen_pembimbing"] ?? ""));
		$targetPeserta = trim((string) ($_POST["target_peserta"] ?? ""));
		$tanggalPelaksanaan = trim((string) ($_POST["tanggal_pelaksanaan"] ?? ""));
		$lokasiKegiatan = trim((string) ($_POST["lokasi_kegiatan"] ?? ""));
		$deskripsiKegiatan = trim((string) ($_POST["deskripsi_kegiatan"] ?? ""));
		$kategoriValid = in_array($kategoriKegiatan, [
			"Akademik",
			"Non-Akademik",
			"Organisasi",
			"Pemahaman Tentang Teknik Informatika",
		], true);
		$dosenValid = in_array($dosenPembimbing, [
			"Yohanes Setiawan, M.Kom.",
			"Chandra Kirana, M.Kom.",
			"Dr. Ellya Helmud, M.Kom.",
		], true);
		$targetValid = in_array($targetPeserta, [
			"Internal Kelas TI1A",
			"Mahasiswa Fakultas TI",
			"Umum / Luar Kampus",
		], true);
		$anggaranValid = preg_match("/^\d+$/", $anggaranKegiatan) === 1;
		$tanggalValid = DateTime::createFromFormat("!Y-m-d", $tanggalPelaksanaan);

		if (
			!preg_match("/^\d{10}$/", $nimMahasiswa) ||
			!$anggaranValid ||
			$namaKegiatan === "" ||
			!$kategoriValid ||
			!$dosenValid ||
			!$targetValid ||
			!$tanggalValid ||
			$tanggalValid->format("Y-m-d") !== $tanggalPelaksanaan ||
			$lokasiKegiatan === "" ||
			$deskripsiKegiatan === ""
		) {
			$_SESSION["error_kegiatan"] = "Lengkapi semua data kegiatan dengan benar.";
			unset($_SESSION["sukses_kegiatan"], $_SESSION["data_kegiatan"]);
		} else {
			$_SESSION["data_kegiatan"] = [
				"nim_mahasiswa" => $nimMahasiswa,
				"anggaran" => $anggaranKegiatan,
				"nama" => $namaKegiatan,
				"kategori" => $kategoriKegiatan,
				"dosen_pembimbing" => $dosenPembimbing,
				"target_peserta" => $targetPeserta,
				"tanggal" => $tanggalPelaksanaan,
				"lokasi" => $lokasiKegiatan,
				"deskripsi" => $deskripsiKegiatan,
			];
			$_SESSION["sukses_kegiatan"] = true;
			unset($_SESSION["error_kegiatan"]);
		}

		header("Location: index.php#rencana-kegiatan");
		exit;
	}

	$nama = trim((string) ($_POST["nama"] ?? ""));
	$email = trim((string) ($_POST["email"] ?? ""));
	$semesterForm = trim((string) ($_POST["semester"] ?? ""));
	$tanggal = trim((string) ($_POST["tanggal"] ?? ""));
	$jenisPesan = trim((string) ($_POST["jenis_pesan"] ?? ""));
	$minat = $_POST["minat"] ?? [];
	$prodi = trim((string) ($_POST["prodi"] ?? ""));
	$pesan = trim((string) ($_POST["pesan"] ?? ""));

	// Checkbox dapat mengirimkan lebih dari satu nilai.
	if (!is_array($minat)) {
		$minat = [];
	}

	// Menyimpan setiap nilai formulir ke dalam session secara terpisah.
	$_SESSION["nama"] = $nama;
	$_SESSION["email"] = $email;
	$_SESSION["semester"] = $semesterForm;
	$_SESSION["tanggal"] = $tanggal;
	$_SESSION["jenis_pesan"] = $jenisPesan;
	$_SESSION["minat"] = $minat;
	$_SESSION["prodi"] = $prodi;
	$_SESSION["pesan"] = $pesan;

	// PRG: mencegah pengiriman POST berulang ketika halaman dimuat ulang.
	header("Location: index.php#contact");
	exit;
}

// Mengamankan data sebelum ditampilkan kembali ke halaman HTML.
// P6: PHP dasar dan pemrograman sisi peladen
// Bagian 1: Variabel dan konstanta
$nim = "2611500013";
$namaMahasiswa = "Ricko Ferdian";
$programStudi = "TI";
$tahunAkademik = "2026/2027";
$semester = 1;
$ipk = 0;
$statusAktif = true;
$catatanTambahan = null;

const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "https://github.com/2611500013-hub/2611500013-PWD-TI1A-2627O.git";

// Bagian 2: Operator
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif) ? "Sesuai rentang" : "Perlu diperiksa";

// Bagian 3: Percabangan if-elseif-else
if ($semester < 3) {
	$keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
	$keteranganSemester = "Semester menengah";
} else {
	$keteranganSemester = "Semester akhir";
}

$namaProdi = ($programStudi == "SI") ? "Sistem Informasi" : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");

// Bagian 4: Percabangan switch-case-default
switch ($programStudi) {
	case "SI":
		$fokusProgramStudi = "Sistem informasi dan proses bisnis";
		break;
	case "TI":
		$fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak";
		break;
	default:
		$fokusProgramStudi = "Belum ditentukan";
}
?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profil Mahasiswa</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<header>
		<div class="header-top">
			<h1>Profil Mahasiswa</h1>

			<button
				class="nav-toggle"
				id="navToggle"
				type="button"
				aria-label="Buka navigasi"
				aria-controls="navMenu"
				aria-expanded="false">
				&#9776;
			</button>
		</div>

		<nav>
			<ul id="navMenu">
				<li><a href="#home">Beranda</a></li>
				<li><a href="#about">Tentang</a></li>
				<li><a href="#rencana-kegiatan">Rencana Kegiatan</a></li>
				<li><a href="#contact">Kontak</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<section id="home">
			<h2>Selamat Datang</h2>
			<p>Halo, saya <strong><?php echo $namaMahasiswa; ?></strong>. Saya sedang mempelajari matakuliah <strong><?php print NAMA_MATA_KULIAH; ?></strong> pada tahun akademik <?php echo $tahunAkademik; ?>.</p>

			<img src="img/foto-profil.jpg" alt="Foto profil Nama Mahasiswa" />
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
					// Perulangan for tanpa array; materi larik dibahas pada P9.
					for ($i = 1; $i <= 5; $i++) {
						echo "<li>Target belajar ke-" . $i . ": ";
						switch ($i) {
							case 1:
								echo "Memahami sintaks dasar PHP.";
								break;
							case 2:
								echo "Menggunakan variabel dan konstanta.";
								break;
							case 3:
								echo "Menerapkan operator dan percabangan.";
								break;
							case 4:
								echo "Menggunakan perulangan for dan while.";
								break;
							default:
								echo "Belum dipetakan";
								break;
						}
						echo "</li>";
					}
					?>
				</ol>

				<h3>Semester (Perulangan while):</h3>
				<ol>
					<?php
					$nomorSemester = 1;
					while ($nomorSemester <= 3) {
						echo "<li>Semester " . $nomorSemester . "</li>";
						$nomorSemester++; // operator penugasan
					}
					?>
				</ol>
			</article>
		</section>

		<section id="rencana-kegiatan">
			<div class="container">
				<h2>Rencana Kegiatan Mahasiswa</h2>

				<?php if (isset($_SESSION["error_kegiatan"])): ?>
					<div class="kegiatan-alert kegiatan-alert-error" role="alert">
						<?= htmlspecialchars($_SESSION["error_kegiatan"], ENT_QUOTES, "UTF-8") ?>
					</div>
					<?php unset($_SESSION["error_kegiatan"]); ?>
				<?php endif; ?>

				<?php if (isset($_SESSION["sukses_kegiatan"], $_SESSION["data_kegiatan"])): ?>
					<article class="kegiatan-success-card" role="status">
						<div class="kegiatan-card-header">
							<div>
								<p class="kegiatan-card-eyebrow">Rencana tersimpan</p>
								<h3>Kegiatan Berhasil Direncanakan!</h3>
							</div>
							<span class="kegiatan-status-badge">Terjadwal</span>
						</div>
						<dl class="kegiatan-data-grid">
							<div class="kegiatan-data-item">
								<dt>Informasi Pengusul</dt>
								<dd><?= htmlspecialchars($_SESSION["data_kegiatan"]["nim_mahasiswa"], ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item">
								<dt>Estimasi Anggaran</dt>
								<dd>Rp <?= htmlspecialchars(number_format((int) $_SESSION["data_kegiatan"]["anggaran"], 0, ",", "."), ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item">
								<dt>Nama Kegiatan</dt>
								<dd><?= htmlspecialchars($_SESSION["data_kegiatan"]["nama"], ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item">
								<dt>Kategori Kegiatan</dt>
								<dd><?= htmlspecialchars($_SESSION["data_kegiatan"]["kategori"], ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item">
								<dt>Dosen Penanggung Jawab / Pembimbing</dt>
								<dd><?= htmlspecialchars($_SESSION["data_kegiatan"]["dosen_pembimbing"], ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item">
								<dt>Target Peserta</dt>
								<dd><?= htmlspecialchars($_SESSION["data_kegiatan"]["target_peserta"], ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item">
								<dt>Tanggal Pelaksanaan</dt>
								<dd><?= htmlspecialchars($_SESSION["data_kegiatan"]["tanggal"], ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item">
								<dt>Lokasi Kegiatan</dt>
								<dd><?= htmlspecialchars($_SESSION["data_kegiatan"]["lokasi"], ENT_QUOTES, "UTF-8") ?></dd>
							</div>
							<div class="kegiatan-data-item kegiatan-data-description">
								<dt>Deskripsi Kegiatan</dt>
								<dd><?= nl2br(htmlspecialchars($_SESSION["data_kegiatan"]["deskripsi"], ENT_QUOTES, "UTF-8")) ?></dd>
							</div>
						</dl>
					</article>
				<?php endif; ?>

				<form id="formKegiatan" action="index.php#rencana-kegiatan" method="post">
					<input type="hidden" name="action" value="submit_rencana">

					<div class="form-group">
						<label for="nim_mahasiswa">NIM Pengusul</label>
						<input type="text" id="nim_mahasiswa" name="nim_mahasiswa" class="input-form" placeholder="Contoh: 2611500013" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" required>
					</div>

					<div class="form-group">
						<label for="anggaran_kegiatan">Estimasi Anggaran (Rp)</label>
						<input type="number" id="anggaran_kegiatan" name="anggaran_kegiatan" class="input-form" placeholder="Masukkan nominal tanpa titik/koma" min="0" step="1" required>
					</div>

					<div class="form-group">
						<label for="nama_kegiatan">Nama Kegiatan</label>
						<input type="text" id="nama_kegiatan" name="nama_kegiatan" class="input-form" required>
					</div>

					<div class="form-group">
						<label for="kategori_kegiatan">Kategori Kegiatan</label>
						<select id="kategori_kegiatan" name="kategori_kegiatan" class="input-form" required>
							<option value="">-- Pilih Kategori --</option>
							<option value="Akademik">Akademik (Seminar/Workshop)</option>
							<option value="Non-Akademik">Non-Akademik (Olahraga/Seni)</option>
							<option value="Organisasi">Organisasi (Rapat/LDKM)</option>
							<option value="Pemahaman Tentang Teknik Informatika">Pemahaman Tentang Teknik Informatika</option>
						</select>
					</div>

					<div class="form-group">
						<label for="dosen_pembimbing">Dosen Penanggung Jawab / Pembimbing</label>
						<select id="dosen_pembimbing" name="dosen_pembimbing" class="input-form" required>
							<option value="">-- Pilih Dosen --</option>
							<option value="Yohanes Setiawan, M.Kom.">Yohanes Setiawan, M.Kom.</option>
							<option value="Chandra Kirana, M.Kom.">Chandra Kirana, M.Kom.</option>
							<option value="Dr. Ellya Helmud, M.Kom.">Dr. Ellya Helmud, M.Kom.</option>
						</select>
					</div>

					<div class="form-group">
						<label for="target_peserta">Target Peserta</label>
						<select id="target_peserta" name="target_peserta" class="input-form" required>
							<option value="">-- Pilih Target --</option>
							<option value="Internal Kelas TI1A">Internal Kelas TI1A</option>
							<option value="Mahasiswa Fakultas TI">Mahasiswa Fakultas TI</option>
							<option value="Umum / Luar Kampus">Umum / Luar Kampus</option>
						</select>
					</div>

					<div class="form-group">
						<label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
						<input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" class="input-form" required>
					</div>

					<div class="form-group">
						<label for="lokasi_kegiatan">Lokasi Kegiatan</label>
						<input type="text" id="lokasi_kegiatan" name="lokasi_kegiatan" class="input-form" required>
					</div>

					<div class="form-group">
						<label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
						<textarea id="deskripsi_kegiatan" name="deskripsi_kegiatan" class="input-form" rows="4" required></textarea>
					</div>

					<button type="submit">Kirim</button>
					<button type="reset">Batal</button>
				</form>
			</div>
		</section>

		<section id="contact">
			<h2>Kontak</h2>

			<p>
				Kunjungi
				<a target="_blank" rel="noopener noreferrer" href="<?= PROFIL_GITHUB ?>">profil GitHub saya</a>.
			</p>

			<form id="contactForm" class="js-contact-form" data-validation="contact" action="index.php" method="post" novalidate>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label><br />

					<input
						class="input-form"
						type="text"
						id="nama"
						name="nama"
						placeholder="Masukkan nama lengkap"
						minlength="3"
						maxlength="50"
						required />
				</div>

				<div class="form-group">
					<label for="email">Email</label><br />

					<input class="input-form" type="email" id="email" name="email" placeholder="nama@email.com" required />
				</div>

				<div class="form-group">
					<label for="semester">Semester</label><br />

					<input class="input-form" type="number" id="semester" name="semester" min="1" max="14" required />
				</div>

				<div class="form-group">
					<label for="tanggal">Tanggal Kunjungan</label><br />

					<input class="input-form" type="date" id="tanggal" name="tanggal" required />
				</div>

				<div class="form-group">
					<p>Jenis Pesan</p>

					<input type="radio" id="pertanyaan" name="jenis_pesan" value="pertanyaan" required />
					<label for="pertanyaan">Pertanyaan</label>

					<input type="radio" id="saran" name="jenis_pesan" value="saran" />
					<label for="saran">Saran</label>
				</div>

				<div class="form-group">
					<p>Topik yang Diminati</p>

					<input type="checkbox" id="minat-html" name="minat[]" value="HTML" />
					<label for="minat-html">HTML</label>

					<input type="checkbox" id="minat-css" name="minat[]" value="CSS" />
					<label for="minat-css">CSS</label>
				</div>

				<div class="form-group">
					<label for="prodi">Program Studi</label><br />

					<select class="input-form" id="prodi" name="prodi" required>
						<option value="">-- Pilih Program Studi --</option>
						<option value="SI">Sistem Informasi</option>
						<option value="TI">Teknik Informatika</option>
					</select>
				</div>

				<div class="form-group">
					<label for="pesan">Pesan</label><br />

					<textarea
						class="input-form"
						id="pesan"
						name="pesan"
						maxlength="300"
						placeholder="Tulis pesan Anda"
						required></textarea>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p class="form-feedback" data-form-feedback aria-live="polite"></p>
			</form>

			<?php if (isset($_SESSION["nama"])): ?>
				<article id="hasilKontak" class="submission-result" aria-live="polite">
					<h3>Data Formulir yang Dikirim</h3>
					<p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($_SESSION["nama"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["email"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Semester:</strong> <?= htmlspecialchars($_SESSION["semester"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Tanggal Kunjungan:</strong> <?= htmlspecialchars($_SESSION["tanggal"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Jenis Pesan:</strong> <?= htmlspecialchars($_SESSION["jenis_pesan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Topik yang Diminati:</strong>
						<?= htmlspecialchars(implode(", ", $_SESSION["minat"] ?? []), ENT_QUOTES, "UTF-8") ?>
					</p>
					<p><strong>Program Studi:</strong> <?= htmlspecialchars($_SESSION["prodi"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Pesan:</strong> <?= nl2br(htmlspecialchars($_SESSION["pesan"] ?? "", ENT_QUOTES, "UTF-8")) ?></p>
				</article>
			<?php endif; ?>
		</section>
	</main>

	<footer>
		<p>&copy; <?= date("Y") ?> <?php echo $namaMahasiswa; ?> [<?= $nim ?>]</p>
	</footer>
	<script src="script.js"></script>
</body>

</html>