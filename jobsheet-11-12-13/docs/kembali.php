<?php
include __DIR__ . '/../includes/auth.php';
$page_title = "Pengembalian";
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Pengembalian Buku</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <div class="search-box">
        <form method="get" action="kembali.php">
            <span>
                <label for="search-input">Cari anggota/buku</label><br>
                <input type="text" id="search-input" name="q" placeholder="Nama anggota atau judul buku...">
            </span>
            <button type="submit">Cari</button>
        </form>
    </div>
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

            </tbody>
        </table>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>