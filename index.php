<?php
// ============================================================
// File No. 7 - index.php
// Entry point: handle logika hapus, lalu tampilkan views/list.php
// ============================================================

require_once "controllers/BukuController.php";

$controller = new BukuController();

// Proses hapus buku
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $controller->destroy((int)$_GET['hapus']);
    header("Location: index.php?notif=hapus");
    exit();
}

// Ambil semua data buku
$data = $controller->index();

// Tampilkan view list
include_once "views/list.php";
