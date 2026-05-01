<?php
// ============================================================
// File No. 2 - BukuController.php
// Controller yang menghubungkan Model Buku dengan View
// ============================================================

require_once dirname(__DIR__) . "/config/Database.php";
require_once dirname(__DIR__) . "/models/Buku.php";

class BukuController {

    public $model;

    public function __construct() {
        $database       = new Database();
        $db             = $database->connect();
        $this->model    = new Buku($db);
    }

    // Ambil semua data buku
    public function index() {
        return $this->model->getAll();
    }

    // Ambil data buku berdasarkan ID
    public function show($id) {
        return $this->model->getById((int)$id);
    }

    // Simpan data buku baru
    public function store($judul, $pengarang) {
        $judul     = htmlspecialchars(strip_tags($judul));
        $pengarang = htmlspecialchars(strip_tags($pengarang));
        return $this->model->create($judul, $pengarang);
    }

    // Update data buku
    public function update($id, $judul, $pengarang) {
        $judul     = htmlspecialchars(strip_tags($judul));
        $pengarang = htmlspecialchars(strip_tags($pengarang));
        return $this->model->update((int)$id, $judul, $pengarang);
    }

    // Hapus data buku
    public function destroy($id) {
        return $this->model->delete((int)$id);
    }
}
