console.log("script.js berhasil dijalankan.");

// 1. Mengakses elemen HTML menggunakan DOM getElementById
const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

// 2. Memasang Event Listener 'click' pada tombol navigasi
navToggle.addEventListener("click", () => {
	// 3. Mengubah class CSS secara bergantian (tambah/hapus class 'nav-open')
	const isOpen = navMenu.classList.toggle("nav-open");

	// 4. Memperbarui status atribut ARIA untuk aksesibilitas halaman
	navToggle.setAttribute("aria-expanded", isOpen);

	// 5. Percabangan if-else untuk mengubah label teks informasi tombol
	if (isOpen) {
		navToggle.setAttribute("aria-label", "Tutup navigasi");
	} else {
		navToggle.setAttribute("aria-label", "Buka navigasi");
	}
});

// 1. Memilih elemen formulir dan elemen umpan balik menggunakan DOM
const contactForm = document.getElementById("contactForm");
const formFeedback = document.getElementById("formFeedback");

// Ambil referensi elemen input
const namaInput = document.getElementById("nama");
const emailInput = document.getElementById("email");
const semesterInput = document.getElementById("semester");

// 2. Menangani peristiwa pengiriman formulir dengan event submit
contactForm.addEventListener("submit", (event) => {
	event.preventDefault();

	const nama = namaInput.value.trim();
	const email = emailInput.value.trim();
	const semester = Number(semesterInput.value);

	if (nama.length < 3 || nama.length > 50) {
		formFeedback.textContent = "Nama lengkap harus diisi 3 sampai 50 karakter.";
		formFeedback.className = "form-feedback error";
		return;
	}

	const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	if (!emailPattern.test(email)) {
		formFeedback.textContent = "Masukkan alamat email yang valid.";
		formFeedback.className = "form-feedback error";
		return;
	}

	if (semesterInput.value === "" || semester < 1 || semester > 14) {
		formFeedback.textContent = "Semester harus diisi dengan angka 1 sampai 14.";
		formFeedback.className = "form-feedback error";
		return;
	}

	if (!contactForm.reportValidity()) {
		formFeedback.textContent = "Periksa kembali kolom formulir yang wajib diisi.";
		formFeedback.className = "form-feedback error";
		return;
	}

	formFeedback.textContent = "Form berhasil divalidasi.";
	formFeedback.className = "form-feedback success";
});

contactForm.addEventListener("input", () => {
	formFeedback.textContent = "";
	formFeedback.className = "form-feedback";
});

contactForm.addEventListener("reset", () => {
	formFeedback.textContent = "";
	formFeedback.className = "form-feedback";
});
