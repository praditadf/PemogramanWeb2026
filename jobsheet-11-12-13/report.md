### Nama : Achmad Pradita Dwi Firmansyah

### Kelas / Absen : TI-2G / 01

### NIM : 254107020130

# Jobsheet 11 — Keamanan Web Dasar

Sub-CPMK: Menerapkan prinsip keamanan web dasar.

## Perubahan dari Jobsheet 10
- Tambah `includes/helpers.php` (`e()` untuk `htmlspecialchars`) dan `includes/csrf.php` (`csrf_token()`, `csrf_field()`, `csrf_verify()`), keduanya di-`require_once` dari `includes/header.php`.
- **XSS**: seluruh output data dari database/`$_GET` (judul, pengarang, nama, alamat, no_hp, nilai pencarian, nama petugas di navbar) dibungkus `e()`.
- **CSRF**: token tersembunyi ditambahkan ke semua form POST (Tambah/Edit/Hapus Buku & Anggota, Login, Register); setiap `proses_*.php` dan `hapus.php` memanggil `csrf_verify()` sebelum menyentuh database.
- **Session fixation**: `session_regenerate_id(true)` dipanggil di `auth/proses_login.php` setelah login berhasil.
- **SQL Injection**: diaudit ulang (tidak ada perubahan kode — sejak Jobsheet 8 semua query sudah prepared statement).
- Tambah `docs/security-checklist.md` — dokumen audit lengkap dengan bukti before/after per kerentanan.

## Cara menjalankan
**Opsi 1 — PHP built-in server**:
```bash
php -S localhost:8000
```

**Opsi 2 — Laragon (Apache)**: lewat virtual host langsung ke folder `jobsheet-11/` (mis. `http://jobsheet11.test/`), atau bersarang di bawah domain proyek (mis. `http://dp2026.test/kode-praktikum/jobsheet-11/`) — path CSS/JS/link/redirect login sudah relatif otomatis (lihat `includes/header.php` & `includes/auth.php`), jadi keduanya jalan.

## Cara menguji
- **CSRF**: login, lalu coba kirim `curl -X POST http://localhost:8000/buku/proses_tambah.php -d "judul=x"` tanpa `csrf_token` → harus mendapat HTTP 403.
- **XSS**: tambah buku dengan judul `<script>alert(1)</script>` → di Daftar Buku harus tampil sebagai teks, bukan pop-up.
- **Guard order**: akses `proses_tambah.php` lewat POST tanpa login sama sekali → tetap redirect ke Login (guard `auth.php` jalan lebih dulu daripada `csrf_verify()`), sudah diverifikasi otomatis.

## Catatan
- Lihat `docs/security-checklist.md` untuk rincian audit dan pemetaan tiap kerentanan ke perbaikannya.

# Jobsheet 12 — Integrasi Modul Peminjaman

Sub-CPMK: Mengintegrasikan front-end dan back-end proyek secara utuh.

## Perubahan dari Jobsheet 11
- Tambah `sql/03_peminjaman.sql` — tabel `peminjaman` (relasi ke `buku` dan `anggota`), melengkapi ERD yang sudah dirancang di Jobsheet 8.
- Tambah modul **Peminjaman** (menghubungkan seluruh entitas yang sudah dibangun sejak Jobsheet 8-10 sekaligus):
  - `peminjaman/tambah.php` + `proses_tambah.php`: pilih anggota + buku (dropdown hanya `stok > 0`), simpan transaksi **dan** kurangi stok buku dalam satu **transaction** (`beginTransaction`/`commit`/`rollBack`) dengan `SELECT ... FOR UPDATE` untuk mencegah race condition stok.
  - `peminjaman/kembali.php` + `proses_kembali.php`: daftar transaksi aktif (`status = 'dipinjam'`), tombol Kembalikan menambah kembali stok buku dalam transaction serupa.
  - `peminjaman/riwayat.php`: histori peminjaman per anggota (JOIN `peminjaman` + `buku`).
- `includes/header.php`: navbar menambahkan menu Peminjaman Baru, Pengembalian, Riwayat (hanya saat login).
- `index.php`: kartu "Sedang Dipinjam" kini `COUNT(*) FROM peminjaman WHERE status = 'dipinjam'` (sebelumnya statis `0`).

## Cara menjalankan
```bash
psql -d simpus_mini -f sql/03_peminjaman.sql
```
**Opsi 1 — PHP built-in server**:
```bash
php -S localhost:8000
```

**Opsi 2 — Laragon (Apache)**: lewat virtual host langsung ke folder `jobsheet-12/` (mis. `http://jobsheet12.test/`), atau bersarang di bawah domain proyek (mis. `http://dp2026.test/kode-praktikum/jobsheet-12/`) — path CSS/JS/link/redirect login sudah relatif otomatis (lihat `includes/header.php` & `includes/auth.php`), jadi keduanya jalan.

## Pengujian end-to-end yang disarankan
Registrasi petugas → Login → Tambah Buku & Anggota → Peminjaman Baru → cek stok buku berkurang di Daftar Buku → cek kartu "Sedang Dipinjam" di Beranda bertambah → Pengembalian → cek stok kembali bertambah dan transaksi hilang dari daftar aktif → Riwayat (pilih anggota) → transaksi muncul berstatus "Selesai" → Logout.

## Catatan
- Validasi bisnis tambahan (anggota dengan peminjaman terlambat >14 hari tidak boleh meminjam buku baru) belum diterapkan — jadi tugas mandiri.
- Operasi stok memakai `SELECT ... FOR UPDATE` di dalam transaction, bukan sekadar `UPDATE buku SET stok = stok - 1` tanpa pengecekan, agar stok tidak bisa menjadi negatif bila dua peminjaman diproses hampir bersamaan.

# Jobsheet 13 — Deployment & Dokumentasi (SIMPUS-Mini)

Sub-CPMK: Mendeploy dan mendokumentasikan aplikasi.

Ini adalah **snapshot akhir** proyek SIMPUS-Mini setelah 13 jobsheet (Jobsheet 1-12), siap didemokan pada UAS.

## Deskripsi Aplikasi

SIMPUS-Mini adalah aplikasi web sederhana untuk mengelola perpustakaan: data buku, anggota, serta transaksi peminjaman/pengembalian, dengan autentikasi petugas.

**Stack:** HTML5, CSS3, JavaScript, PHP native, PostgreSQL (PDO_PGSQL).

## ERD Final

```
buku            anggota           users              peminjaman
------          --------          ------             -----------
id (PK)         id (PK)           id (PK)             id (PK)
judul           nama              nama                buku_id (FK -> buku.id)
pengarang       no_anggota (UQ)   username (UQ)        anggota_id (FK -> anggota.id)
tahun           alamat            password (hash)      tanggal_pinjam
isbn            no_hp             role                 tanggal_kembali
stok                                                    status
kategori
```

## Fitur per Role

| Fitur | Tamu (tanpa login) | Petugas (login) |
|---|---|---|
| Lihat Beranda & statistik | Ya | Ya |
| Lihat Daftar Buku | Ya | Ya |
| Tambah/Edit/Hapus Buku | Tidak | Ya |
| Kelola Anggota (CRUD) | Tidak | Ya |
| Peminjaman Baru | Tidak | Ya |
| Pengembalian | Tidak | Ya |
| Riwayat Peminjaman | Tidak | Ya |

## Instalasi & Menjalankan

1. **Clone/salin folder ini** ke server (lokal atau hosting yang mendukung PHP + PostgreSQL).
2. **Buat database & impor skema** (urutan penting karena `peminjaman` mereferensikan `buku`/`anggota`):
   ```bash
   createdb simpus_mini
   psql -d simpus_mini -f sql/01_buku_anggota.sql
   psql -d simpus_mini -f sql/02_users.sql
   psql -d simpus_mini -f sql/03_peminjaman.sql
   ```
3. **Konfigurasi koneksi**: kredensial database dibaca dari `includes/config.php`, yang mengambil environment variable (`DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`) dengan fallback ke nilai default lokal. Set environment variable sebelum menjalankan server bila kredensial produksi berbeda:
   ```bash
   DB_HOST=127.0.0.1 DB_NAME=simpus_mini DB_USER=produser DB_PASS=rahasia php -S localhost:8000
   ```
   Jangan mengubah nilai default di `includes/config.php` menjadi kredensial asli lalu meng-commit-nya ke repository publik.
4. **Jalankan** — path CSS/JS/link/redirect login dihitung relatif otomatis di `includes/header.php` & `includes/auth.php` berdasarkan kedalaman folder halaman, jadi tidak lagi terikat harus dijalankan dari root server:
   - **Opsi 1 — PHP built-in server**:
     ```bash
     php -S localhost:8000
     ```
   - **Opsi 2 — Laragon (Apache)**: lewat virtual host langsung ke folder `jobsheet-13/` (mis. `http://jobsheet13.test/`), atau bersarang di bawah domain proyek (mis. `http://dp2026.test/kode-praktikum/jobsheet-13/`) — dua-duanya jalan.
5. Buka `http://localhost:8000/index.php` (atau URL Laragon yang dipakai), registrasi akun petugas pertama lewat halaman `auth/register.php`.

## Struktur Folder

```
jobsheet-13/
├── index.php                  Beranda (statistik real-time dari DB)
├── includes/                  koneksi.php, config.php, header.php, footer.php, auth.php, csrf.php, helpers.php
├── assets/css, assets/js       styling & interaktivitas
├── buku/                       CRUD Buku
├── anggota/                    CRUD Anggota
├── auth/                       Register, Login, Logout
├── peminjaman/                 Peminjaman, Pengembalian, Riwayat
├── sql/                        skema database (01-03, jalankan berurutan)
└── docs/                       wireframe.md, security-checklist.md, manual-pengguna.md
```

## Dokumen Pendukung
- [`docs/wireframe.md`](docs/wireframe.md) — rancangan UX (Jobsheet 4)
- [`docs/security-checklist.md`](docs/security-checklist.md) — audit keamanan (Jobsheet 11)
- [`docs/manual-pengguna.md`](docs/manual-pengguna.md) — panduan penggunaan aplikasi
- [`../../Setup-Database-PostgreSQL-Laragon.md`](../../Setup-Database-PostgreSQL-Laragon.md) — cara menyiapkan PostgreSQL & database `simpus_mini` khusus di Laragon

## Catatan
- Seluruh berkas PHP telah dilolos-uji `php -l` (tanpa error sintaks). Sudah diverifikasi jalan end-to-end (Apache + PHP 8.3 + PostgreSQL 14.5 di Laragon), termasuk lewat virtual host langsung maupun bersarang di bawah domain proyek — lihat `Setup-Database-PostgreSQL-Laragon.md` di root repo untuk langkah setup database-nya.
- Untuk presentasi UAS, siapkan penjelasan alasan desain teknis: mengapa struktur tabel dan alur transaksi peminjaman dirancang seperti ini (lihat `README.md` Jobsheet 12 untuk detail transaksi stok).