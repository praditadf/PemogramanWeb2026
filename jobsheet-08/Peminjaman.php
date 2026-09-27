<?php 
$page_title = "Peminjaman";
include __DIR__ . '/includes/header.php';


?>
        <section>
            <h2>Peminjaman Buku Baru</h2>
        </section>
        <form>
            <p>
                <label for="anggota_id">Anggota</label></br>
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
                <label for="tgl_pinjam">Tanggal Pinjam</label><br>
                <input type="date" id="tgl_pinjam" name="tgl_pinjam" required>
            </p>
            <p>
                <button type="submit">Simpan</button>
            </p>
        </form>
<?php include __DIR__ . '/includes/footer.php'; ?>