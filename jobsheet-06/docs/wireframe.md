# Wireframe & User Flow — SIMPUS-Mini

Sub-CPMK: Merancang UI/UX aplikasi (proyek).

## Aktor
- **Tamu**: hanya bisa melihat katalog buku (Beranda, Daftar Buku) tanpa login.
- **Petugas**: login untuk mengakses seluruh fitur CRUD dan transaksi peminjaman.

## User Flow — Peminjaman Buku

```
[Petugas Login] -> [Dashboard] -> [Pilih menu "Peminjaman Baru"]
        -> [Pilih Anggota] -> [Pilih Buku (stok > 0)]
        -> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]
```

## User Flow — Pengembalian Buku

```
[Dashboard] -> [Menu "Pengembalian"] -> [Cari transaksi aktif (anggota/buku)]
        -> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1]
        -> [Kembali ke Dashboard]
```

## Wireframe: Halaman Login

```
+--------------------------------------+
|              SIMPUS-Mini             |
|--------------------------------------|
|                                      |
|        [ Login Petugas ]             |
|                                      |
|   Username : [______________]        |
|   Password : [______________]        |
|                                      |
|           [   Masuk   ]              |
|                                      |
|           Lupa Password?             |
|                                      |
|   Belum punya akun? Daftar di sini   |
+--------------------------------------+
```

## Wireframe: Dashboard Petugas

```
+-----------------------------------------------------------------+
| SIMPUS-Mini      Beranda | Buku | Anggota | Peminjaman | Logout |
|-----------------------------------------------------------------|
|  [Total Buku]        [Total Anggota]        [Sedang Dipinjam]   |
|                                                                 |
|  Aksi Cepat:                                                    |
|  [ + Peminjaman Baru ]   [ + Pengembalian ]                     |
|                                                                 |
|  Transaksi Terbaru                                              |
|  ---------------------------------------------------------------|
|  Anggota | Buku | Tgl Pinjam | Status                           |
+-----------------------------------------------------------------+
```

## Wireframe: Form Peminjaman

```
+----------------------------------------+
|  Form Peminjaman Buku                  |
|----------------------------------------|
|  Anggota : [ dropdown pilih anggota ]  |
|  Buku    : [ dropdown, hanya stok>0 ]  |
|  Tanggal Pinjam : [ auto: hari ini ]   |
|                                        |
|             [  Simpan  ]               |
+----------------------------------------+
```

## Wireframe: Form Pengembalian

```
+---------------------------------------------+
|  Pengembalian Buku                          |
|---------------------------------------------|
|  Cari transaksi aktif:                      |
|  [ nama anggota / judul buku ______ ]       |
|                                             |
|  Anggota | Buku | Tgl Pinjam | [Kembalikan] |
+---------------------------------------------+
```

## Wireframe: Riwayat Peminjaman per Anggota

```
+---------------------------------------------------+
|  Riwayat Peminjaman — Siti Aminah                 |
|---------------------------------------------------|
|  Buku            | Pinjam   | Kembali | Status    |
|  Laskar Pelangi  | 01/07    | 10/07   | Selesai   |
|  Bumi Manusia    | 15/07    | -       | Dipinjam  |
+---------------------------------------------------+
```
## Wireframe: Registrasi Anggota Baru

```
+--------------------------------------+
|              SIMPUS-Mini             |
|--------------------------------------|
|                                      |
|        [ Registrasi Anggota ]        |
|                                      |
|   Nama        : [______________]     |
|   Password    : [______________]     |
|   No. Telepon : [______________]     |
|   Email       : [______________]     |
|                                      |
|           [   Daftar   ]             |
|                                      |
|                                      |
|   Sudah punya akun? Login di sini    |
+--------------------------------------+
```