<?php
// ============================================================
// File No. 1 - Database.php
// Kelas koneksi database — DB: pbo_parsha
// ============================================================

class Database {
    private $host   = "localhost";
    private $user   = "root";
    private $pass   = "";
    private $db     = "pbo_parsha";

    public function connect() {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($conn->connect_error) {
            die("
                <div style='font-family:sans-serif;background:#d1fae5;color:#065f46;
                    padding:20px;border-radius:8px;margin:20px;border:1px solid #6ee7b7;'>
                    <strong>❌ Koneksi Gagal!</strong><br>
                    " . $conn->connect_error . "
                </div>
            ");
        }

        $conn->set_charset("utf8");
        return $conn;
    }
}
