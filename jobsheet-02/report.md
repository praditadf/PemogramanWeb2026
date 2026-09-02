# Jobsheet 2 — CSS3 Styling Dasar

Sub-CPMK: Mengimplementasikan styling dasar dengan CSS3.

## Perubahan dari Jobsheet 1

- Tambah `assets/css/style.css` (box model, Flexbox untuk navbar, CSS Grid untuk kartu statistik Beranda).
  ![Screenshot](../jobsheet-02/Dokumentasi/img/img1.png)
- Semua halaman `.html` ditambahkan `<link rel="stylesheet">` ke `style.css` (path relatif menyesuaikan kedalaman folder).
  ![Screenshot](../jobsheet-02/Dokumentasi/img/img2.png)
- Struktur HTML **tidak diubah** — hanya tampilan.

## - index.html

![Screenshot](../jobsheet-02/Dokumentasi/img/index.png)

## buku/list.html

![Screenshot](../jobsheet-02/Dokumentasi/img/buku-list.png)

## buku/tambah.html

![Screenshot](../jobsheet-02/Dokumentasi/img/buku-tambah.png)

## anggota/list.html

![Screenshot](../jobsheet-02/Dokumentasi/img/anggota-list.png)

## anggota/tambah.html

![Screenshot](../jobsheet-02/Dokumentasi/img/anggota-tambah.png)

## Catatan

- Kartu statistik di Beranda memakai `main section:nth-of-type(2)` sebagai grid 3 kolom.
- Class CSS bersifat generik (berbasis tag semantic + `nth-child`) agar bisa dipakai ulang di halaman Anggota tanpa duplikasi class.
