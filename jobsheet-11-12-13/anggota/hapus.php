<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

csrf_verify();

$id = $_POST['id'] ?? null;
$role = $_SESSION['role'] ?? null;
if ($role !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anda tidak memiliki izin untuk menghapus anggota.'];
} elseif ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil dihapus.'];
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anggota tidak bisa dihapus karena masih memiliki riwayat peminjaman.'];
    }
}

header('Location: list.php');
exit;