<?php
include_once 'config/Database.php';
include_once 'models/Transaksi.php';
// Kamu juga perlu include model Layanan untuk ambil harga per kg

class TransaksiViewModel {
    private $model;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->model = new Transaksi($this->db);
    }

    public function getDaftarTransaksi() {
        return $this->model->readAll();
    }

    public function tambahTransaksi($id_pelanggan, $id_layanan, $berat) {
        // LOGIKA BISNIS: Hitung Total Bayar otomatis di sini
        // 1. Ambil harga layanan dari database (manual query simpel utk contoh)
        $query = "SELECT harga_per_kg FROM layanan WHERE id_layanan = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id_layanan]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $harga_per_kg = $row['harga_per_kg'];
        
        // 2. Hitung total
        $total_bayar = $berat * $harga_per_kg;

        // 3. Susun data untuk dikirim ke Model
        $data = [
            'id_pelanggan' => $id_pelanggan,
            'id_layanan' => $id_layanan,
            'berat_kg' => $berat,
            'total_bayar' => $total_bayar,
            'tanggal' => date('Y-m-d')
        ];

        // 4. Panggil Model untuk simpan
        return $this->model->create($data);
    }

    public function fetchOne($id) {
        return $this->model->readOne($id);
    }

    public function deleteTransaksi($id) {
        return $this->model->delete($id);
    }

    public function updateTransaksi($id, $id_pelanggan, $id_layanan, $berat) {
        // Hitung ulang total bayar saat update
        $query = "SELECT harga_per_kg FROM layanan WHERE id_layanan = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id_layanan]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $harga_per_kg = $row['harga_per_kg'];
        $total_bayar = $berat * $harga_per_kg;

        return $this->model->update($id, $id_pelanggan, $id_layanan, $berat, $total_bayar);
    }
}
?>