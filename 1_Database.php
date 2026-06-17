<?php
// database.php

class Database {
    private $host = "localhost";
    private $db_name = "db_simulasi_pbo_ti1c_qonitahilyatulfirdausa";
    private $username = "root";
    private $password = "";
    private $charset = "utf8mb4"; // Tambahan charset
    public $conn;

    public function getConnection() {
        $this->conn = null;

        // Mengatur opsi atribut PDO demi keamanan dan kenyamanan coding
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Hasil fetch otomatis array asosiatif
            PDO::ATTR_EMULATE_PREPARES   => false,            // Proteksi SQL Injection asli MySQL
        ];

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset,
                $this->username,
                $this->password,
                $options // Lewatkan opsi di sini
            );

        } catch(PDOException $exception) {
            // Gunakan die() agar program berhenti jika database mati
            die("Koneksi database gagal: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>
