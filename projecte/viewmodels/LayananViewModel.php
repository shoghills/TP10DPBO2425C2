<?php
include_once 'config/Database.php';
include_once 'models/Layanan.php';

class LayananViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Layanan($db);
    }

    public function fetchAll() {
        $stmt = $this->model->read();
        // Mengembalikan data dalam bentuk array associative
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        // Validasi sederhana bisa ditaruh di sini
        if (!empty($data['nama_layanan']) && !empty($data['harga_per_kg'])) {
            return $this->model->create($data['nama_layanan'], $data['harga_per_kg']);
        }
        return false;
    }

    public function fetchOne($id) {
        return $this->model->readOne($id);
    }

    public function edit($data) {
        return $this->model->update($data['id'], $data['nama_layanan'], $data['harga_per_kg']);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }
}


?>