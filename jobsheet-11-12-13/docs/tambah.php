<?php 
require __DIR__ . '/../includes/auth.php';
$page_title = "Peminjaman";
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <sec>
            <h2>Peminjaman Buku Baru</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <form method="post" action="proses_tambah.php">
                <p>
                    <label for="anggota_id">Anggota</label><br>
                    <select id="anggota_id" name="anggota_id" required>
                        <option value="">-- Pilih Anggota --</option>
                    </select>
                </p>
                <p>
                    <label for="buku_id">Buku (hanya yang stoknya tersedia)</label><br>
                    <select id="buku_id" name="buku_id" required>
                        <option value="">-- Pilih Buku --</option>
                    </select>
                </p>
                <p>
                    <button type="submit">Simpan Peminjaman</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>