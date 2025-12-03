<?php
class Pelanggan {
    private $conn;
    private $table = "pelanggan";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_pelanggan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Simpan data baru
    public function create($nama, $hp, $alamat) {
        $query = "INSERT INTO " . $this->table . " (nama_pelanggan, no_hp, alamat) VALUES (:nama, :hp, :alamat)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":hp", $hp);
        $stmt->bindParam(":alamat", $alamat);
        
        return $stmt->execute();
    }

    // Ambil 1 data untuk diedit
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_pelanggan = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update Data
    public function update($id, $nama, $hp, $alamat) {
        $query = "UPDATE " . $this->table . " SET nama_pelanggan=:nama, no_hp=:hp, alamat=:alamat WHERE id_pelanggan=:id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":hp", $hp);
        $stmt->bindParam(":alamat", $alamat);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    // Delete Data
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_pelanggan = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>