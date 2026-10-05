### Nama : Achmad Pradita Dwi Firmansyah

### Kelas / Absen : TI-2G / 01

### NIM : 254107020130

# Jobsheet 9 — CRUD Penuh

Sub-CPMK: Membangun fitur CRUD pada proyek.

## Perubahan dari Jobsheet 8
- Tambah `buku/edit.php` + `buku/proses_edit.php`, `anggota/edit.php` + `anggota/proses_edit.php` — melengkapi Create+Read (Jobsheet 8) dengan **Update**.
- Tambah `buku/hapus.php`, `anggota/hapus.php` — **Delete**, hanya menerima `POST` (bukan GET) agar tidak terpicu tidak sengaja lewat link/crawler.
- Tombol Hapus di `list.php` sekarang berupa `<form class="form-hapus" method="post">` sungguhan (bukan lagi tombol `<button>` polos) — `app.js` (`initHapusConfirm`) diubah untuk konfirmasi di event `submit` (bisa `preventDefault()`), bukan `click`.
- `buku/list.php` & `anggota/list.php`: tambah **pagination** (`LIMIT`/`OFFSET`, 5 baris/halaman) dan **pencarian server-side** (`WHERE judul/nama ILIKE :kw`) — form GET, menggantikan kolom cari client-side murni dari Jobsheet 5/6.

## Cara menjalankan
**Opsi 1 — PHP built-in server**:
```bash
php -S localhost:8000
```
Buka `http://localhost:8000/index.php`, uji siklus lengkap: tambah → tampil → ubah (Edit) → tampil berubah → hapus → hilang dari list.

**Opsi 2 — Laragon (Apache)**: lewat virtual host langsung ke folder `jobsheet-09/` (mis. `http://jobsheet09.test/`), atau bersarang di bawah domain proyek (mis. `http://dp2026.test/kode-praktikum/jobsheet-09/`) — path CSS/JS/link sudah relatif otomatis (lihat `includes/header.php`), jadi keduanya jalan.

## Catatan
- Kolom pencarian (`#search-input`) di halaman ini melayani dua peran: filter instan client-side (JS, dari Jobsheet 5) untuk baris yang sedang tampil di halaman saat ini, dan pencarian penuh lintas-halaman lewat tombol "Cari" (server-side).
- Nilai `q` dari pencarian belum di-escape saat ditampilkan kembali ke `value` input — ini **sengaja belum diperbaiki** di sini; audit dan perbaikan XSS dilakukan menyeluruh di Jobsheet 11.

# Jobsheet 10 — Autentikasi & Manajemen Sesi

Sub-CPMK: Menerapkan autentikasi & manajemen sesi pengguna.

## Perubahan dari Jobsheet 9
- Tambah `sql/02_users.sql` — tabel `users` (nama, username, password, role).
- Tambah `auth/register.php` + `proses_register.php` (password disimpan dengan `password_hash()`, cek username duplikat), `auth/login.php` + `proses_login.php` (`password_verify()`), `auth/logout.php` (`session_destroy()`).
- Tambah `includes/auth.php` — guard clause: redirect ke `auth/login.php` bila `$_SESSION['user_id']` belum ada. **Wajib di-include sebagai baris pertama** (sebelum `header.php`) agar `header('Location: ...')` masih bisa dipanggil sebelum ada output HTML.
- `includes/header.php`: `session_start()` diubah jadi `if (session_status() === PHP_SESSION_NONE)` agar tidak konflik dengan `auth.php` yang juga memulai session; navbar kini menampilkan nama petugas + Logout jika sudah login, atau link Login jika belum.
- Halaman yang **dikunci** (butuh login): `buku/tambah.php`, `buku/edit.php`, `buku/proses_tambah.php`, `buku/proses_edit.php`, `buku/hapus.php`, seluruh halaman `anggota/*`.
- Halaman yang **tetap publik**: `index.php` (Beranda) dan `buku/list.php` (katalog buku bisa dilihat Tamu tanpa login — sesuai wireframe Jobsheet 4).

## Persiapan database
Jalankan skema tambahan:
```bash
psql -d simpus_mini -f sql/02_users.sql
```

## Cara menjalankan
**Opsi 1 — PHP built-in server**:
```bash
php -S localhost:8000
```
Uji: akses `http://localhost:8000/buku/tambah.php` langsung tanpa login → harus redirect ke halaman Login. Daftar akun via Register, login, coba akses halaman yang sama → berhasil.

**Opsi 2 — Laragon (Apache)**: lewat virtual host langsung ke folder `jobsheet-10/` (mis. `http://jobsheet10.test/`), atau bersarang di bawah domain proyek (mis. `http://dp2026.test/kode-praktikum/jobsheet-10/`) — path CSS/JS/link/redirect login sudah relatif otomatis (lihat `includes/header.php` & `includes/auth.php`), jadi keduanya jalan.

## Catatan
- Guard `auth.php` sudah diverifikasi mengembalikan HTTP 302 ke `auth/login.php` untuk halaman terkunci meski database belum tersambung (guard berjalan sebelum kode butuh koneksi DB).
- Perbedaan akses berdasarkan `role` (mis. hanya `admin` boleh hapus anggota) belum diterapkan di jobsheet ini — jadi tugas mandiri.