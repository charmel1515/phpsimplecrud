<?php

class Database {

    // Konfigurasi database dapat dilihat di SQLYog atau HeidiSQL
    private $db_host = "localhost"; // database host
    private $db_user = "root"; // database username
    private $db_pass = ""; // database password
    private $db_name = "db_simplecrud"; // database name
    public $conn; // database connection

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct(){
        // Memanggil method untuk membuat koneksi database
        $this->getConnection();
    }
    
    // Method untuk membuat koneksi database
    public function getConnection(){
        try{
            // Membuat koneksi database menggunakan mysqli
            $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

            // Set karakter set agar mendukung utf8 (emoji & multi-bahasa)
            if (!$this->conn->set_charset("utf8mb4")) {
                // tidak fatal, tapi beri tahu lewat warning
                trigger_error("Gagal set charset: " . $this->conn->error, E_USER_WARNING);
            }

            // Cek koneksi database
            if ($this->conn->connect_error) {
                // Melemparkan exception jika koneksi gagal
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch(Exception $e){
            // Menangani exception dan menampilkan pesan error
            die("Connection error: " . $e->getMessage());
        }
    }

    /**
     * Mengembalikan semua baris hasil query sebagai array asosiatif.
     * Digunakan mis. oleh MasterData::getJenis(), getKelas(), getJurusan()
     */
    public function getAll($query) {
        $result = $this->conn->query($query);
        if ($result === false) {
            // Tampilkan warning agar developer tahu querynya bermasalah
            trigger_error("Query error: " . $this->conn->error . " -- Query: " . $query, E_USER_WARNING);
            return [];
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // Bebaskan result set
        $result->free();
        return $data;
    }

    /**
     * Mengembalikan satu baris (assoc) dari query, atau null jika tidak ada.
     */
    public function getOne($query) {
        $result = $this->conn->query($query);
        if ($result === false) {
            trigger_error("Query error: " . $this->conn->error . " -- Query: " . $query, E_USER_WARNING);
            return null;
        }
        $row = $result->fetch_assoc();
        $result->free();
        return $row ? $row : null;
    }

    /**
     * Menjalankan query INSERT/UPDATE/DELETE.
     * Mengembalikan true/false. Untuk INSERT, id terakhir tersedia via $this->conn->insert_id.
     */
    public function execute($query) {
        $res = $this->conn->query($query);
        if ($res === false) {
            trigger_error("Execute error: " . $this->conn->error . " -- Query: " . $query, E_USER_WARNING);
            return false;
        }
        return true;
    }

    /**
     * Escaping sederhana untuk nilai yang masuk ke query manual (jika diperlukan).
     */
    public function escape($value) {
        return $this->conn->real_escape_string($value);
    }

}

?>
