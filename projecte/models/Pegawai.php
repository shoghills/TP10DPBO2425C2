<?php
class Pegawai {
    private $conn;
    private $table = "pegawai";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_pegawai DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // HAPUS parameter $gaji, dan GANTI 'posisi' jadi 'jabatan'
    public function create($nama, $jabatan) {
        $query = "INSERT INTO " . $this->table . " (nama_pegawai, jabatan) VALUES (:nama, :jabatan)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":jabatan", $jabatan);
        
        return $stmt->execute();
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_pegawai = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // GANTI 'posisi' jadi 'jabatan' dan hapus gaji
    public function update($id, $nama, $jabatan) {
        $query = "UPDATE " . $this->table . " SET nama_pegawai=:nama, jabatan=:jabatan WHERE id_pegawai=:id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":jabatan", $jabatan);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_pegawai = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>