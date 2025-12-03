<?php
include_once 'config/Database.php';
include_once 'models/Pelanggan.php';

class PelangganViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Pelanggan($db);
    }

    public function fetchAll() {
        $stmt = $this->model->read();
        // Mengembalikan data dalam bentuk array associative
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        // Validasi sederhana bisa ditaruh di sini
        if (!empty($data['nama']) && !empty($data['no_hp'])) {
            return $this->model->create($data['nama'], $data['no_hp'], $data['alamat']);
        }
        return false;
    }

    public function fetchOne($id) {
        return $this->model->readOne($id);
    }

    public function edit($data) {
        return $this->model->update($data['id'], $data['nama'], $data['no_hp'], $data['alamat']);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }
}
?>