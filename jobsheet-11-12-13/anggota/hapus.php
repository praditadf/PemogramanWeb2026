<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
$role = $_SESSION['user']['role'] ?? null;
if ($id && $role === 'admin') {
    $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil dihapus.'];
}
if ($role !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anda tidak memiliki izin untuk menghapus anggota.'];
}

header('Location: list.php');
exit;