<?php
class Transaksi {
    private $conn;
    private $table_name = "transaksi";

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Mengambil semua data (Read All)
    public function readAll() {
        $query = "SELECT t.id_transaksi, p.nama_pelanggan, l.nama_layanan, t.berat_kg, t.total_bayar, t.status, t.tanggal_transaksi 
                  FROM " . $this->table_name . " t
                  JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                  JOIN layanan l ON t.id_layanan = l.id_layanan
                  ORDER BY t.id_transaksi DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 2. Simpan transaksi baru (Create)
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id_pelanggan, id_layanan, berat_kg, total_bayar, tanggal_transaksi, status) 
                  VALUES (:pelanggan, :layanan, :berat, :total, :tanggal, 'Proses')";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":pelanggan", $data['id_pelanggan']);
        $stmt->bindParam(":layanan", $data['id_layanan']);
        $stmt->bindParam(":berat", $data['berat_kg']);
        $stmt->bindParam(":total", $data['total_bayar']);
        $stmt->bindParam(":tanggal", $data['tanggal']);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 3. Ambil 1 data untuk Edit (Read One) -> INI YANG TADI ERROR
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_transaksi = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Update Data (Update)
    public function update($id, $pelanggan, $layanan, $berat, $total) {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_pelanggan=:p, id_layanan=:l, berat_kg=:b, total_bayar=:t 
                  WHERE id_transaksi=:id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":p", $pelanggan);
        $stmt->bindParam(":l", $layanan);
        $stmt->bindParam(":b", $berat);
        $stmt->bindParam(":t", $total);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    // 5. Hapus Data (Delete)
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_transaksi = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>