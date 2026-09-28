<?php 
$page_title = "Pengembalian";
include __DIR__ . '/includes/header.php';


?>
<section>
    <h2>Pengembalian Buku</h2>
</section>
<br class="search-box">
<label for="search-input">Cari Transaksi Aktif:</label></br>
<input type="text" id="search-input" placeholder="Ketik nama anggota / judul buku...">
</div>
<p id="loading-indicator" style="display:none;">Memuat data...</p>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>