<?php
class Layanan {
    private $conn;
    private $table = "layanan";

    public function __construct($db) {
        $this->conn = $db;
    }

    //ambil semua data
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_layanan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($nama, $harga_per_kg) {
        $query = "INSERT INTO " . $this->table . " (nama_layanan, harga_per_kg) VALUES (:nama, :harga)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":harga", $harga_per_kg);
        
        return $stmt->execute();
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_layanan = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nama, $harga_per_kg) {
        $query = "UPDATE " . $this->table . " SET nama_layanan=:nama, harga_per_kg=:harga WHERE id_layanan=:id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":harga", $harga_per_kg);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_layanan = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }



    
}
?>