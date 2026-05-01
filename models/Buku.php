<?php
// ============================================================
// File No. 3 - Buku.php
// Model untuk operasi CRUD tabel buku
// ============================================================

class Buku {

    private $conn;
    private $table = "buku";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data buku
    public function getAll() {
        $query = "SELECT * FROM {$this->table} ORDER BY id ASC";
        return $this->conn->query($query);
    }

    // Ambil data buku berdasarkan ID (prepared statement)
    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Tambah buku baru (prepared statement)
    public function create($judul, $pengarang) {
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table} (judul, pengarang) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $judul, $pengarang);
        return $stmt->execute();
    }

    // Update data buku (prepared statement)
    public function update($id, $judul, $pengarang) {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table} SET judul = ?, pengarang = ? WHERE id = ?"
        );
        $stmt->bind_param("ssi", $judul, $pengarang, $id);
        return $stmt->execute();
    }

    // Hapus data buku (prepared statement)
    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM {$this->table} WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
