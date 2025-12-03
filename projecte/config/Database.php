<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "laundry_db";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->pass);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Koneksi error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>