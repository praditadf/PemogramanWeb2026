<?php 
require __DIR__ . '/../includes/auth.php';
$page_title = "Riwayat";
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/koneksi.php';


?>
<section>
    <h2>Riwayat Peminjaman</h2>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th>Buku</th>
                <th>Pinjam</th>
                <th>Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>