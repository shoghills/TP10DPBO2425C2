<?php
include_once 'config/Database.php';
include_once 'models/Pegawai.php';

class PegawaiViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Pegawai($db);
    }

    public function fetchAll() {
        $stmt = $this->model->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        // Pastikan input nama dan jabatan ada
        if (!empty($data['nama_pegawai']) && !empty($data['jabatan'])) {
            // HAPUS $data['gaji'] karena di form tidak ada
            return $this->model->create($data['nama_pegawai'], $data['jabatan']);
        }
        return false;
    }

    public function fetchOne($id) {
        return $this->model->readOne($id);
    }

    public function edit($data) {
        // HAPUS $data['gaji']
        return $this->model->update($data['id'], $data['nama_pegawai'], $data['jabatan']);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }
}
?>