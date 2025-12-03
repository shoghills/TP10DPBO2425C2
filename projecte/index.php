<?php
// index.php

// Ambil parameter page, default ke 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// --- Header ---
include 'views/template/header.php';

// --- Routing ---
switch ($page) {
    case 'home':
        echo "<h1>Selamat Datang di Sistem Laundry</h1>";
        echo "<p>Silakan pilih menu di atas untuk mengelola data.</p>";
        break;

    // ==========================================
    // MODULE: PELANGGAN (Sudah Lengkap)
    // ==========================================
    case 'pelanggan_list':
        require_once 'viewmodels/PelangganViewModel.php';
        $viewModel = new PelangganViewModel();
        $data = $viewModel->fetchAll();
        include 'views/pelanggan_list.php';
        break;
        
    case 'pelanggan_form': // Create
        require_once 'viewmodels/PelangganViewModel.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $viewModel = new PelangganViewModel();
            if ($viewModel->insert($_POST)) {
                header("Location: index.php?page=pelanggan_list");
            } else {
                echo "Gagal simpan data!";
            }
        } else {
            include 'views/pelanggan_form.php';
        }
        break;

    case 'pelanggan_edit': // Update
        require_once 'viewmodels/PelangganViewModel.php';
        $viewModel = new PelangganViewModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($viewModel->edit($_POST)) {
                header("Location: index.php?page=pelanggan_list");
            }
        } else {
            $id = $_GET['id'];
            $data = $viewModel->fetchOne($id);
            include 'views/pelanggan_form.php';
        }
        break;

    case 'pelanggan_delete': // Delete
        require_once 'viewmodels/PelangganViewModel.php';
        $viewModel = new PelangganViewModel();
        $id = $_GET['id'];
        $viewModel->remove($id);
        header("Location: index.php?page=pelanggan_list");
        break;

    // ==========================================
    // MODULE: LAYANAN (Baru Ditambahkan Lengkap)
    // ==========================================
    case 'layanan_list':
        require_once 'viewmodels/LayananViewModel.php';
        $viewModel = new LayananViewModel();
        $data = $viewModel->fetchAll();
        include 'views/layanan_list.php';
        break;

    case 'layanan_form': // Create
        require_once 'viewmodels/LayananViewModel.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $viewModel = new LayananViewModel();
            if ($viewModel->insert($_POST)) {
                header("Location: index.php?page=layanan_list");
            }
        } else {
            include 'views/layanan_form.php';
        }
        break;

    case 'layanan_edit': // Update
        require_once 'viewmodels/LayananViewModel.php';
        $viewModel = new LayananViewModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($viewModel->edit($_POST)) { // Pastikan function edit() ada di VM Layanan
                header("Location: index.php?page=layanan_list");
            }
        } else {
            $id = $_GET['id'];
            $data = $viewModel->fetchOne($id); // Pastikan function fetchOne() ada di VM Layanan
            include 'views/layanan_form.php';
        }
        break;

    case 'layanan_delete': // Delete
        require_once 'viewmodels/LayananViewModel.php';
        $viewModel = new LayananViewModel();
        $id = $_GET['id'];
        $viewModel->remove($id); // Pastikan function remove() ada di VM Layanan
        header("Location: index.php?page=layanan_list");
        break;

    // ==========================================
    // MODULE: PEGAWAI (Baru Ditambahkan Lengkap)
    // ==========================================
    case 'pegawai_list':
        require_once 'viewmodels/PegawaiViewModel.php';
        $viewModel = new PegawaiViewModel();
        $data = $viewModel->fetchAll();
        include 'views/pegawai_list.php';
        break;

    case 'pegawai_form': // Create
        require_once 'viewmodels/PegawaiViewModel.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $viewModel = new PegawaiViewModel();
            // Tambahkan pengecekan error
            if ($viewModel->insert($_POST)) {
                header("Location: index.php?page=pegawai_list");
            } else {
                // INI YANG KURANG TADI:
                echo "<h1>Gagal Menyimpan Data Pegawai!</h1>";
                echo "<p>Cek kembali koneksi database atau nama kolom.</p>";
                echo "<a href='index.php?page=pegawai_form'>Kembali</a>";
            }
        } else {
            include 'views/pegawai_form.php';
        }
        break;

    case 'pegawai_edit': // Update
        require_once 'viewmodels/PegawaiViewModel.php';
        $viewModel = new PegawaiViewModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($viewModel->edit($_POST)) {
                header("Location: index.php?page=pegawai_list");
            }
        } else {
            $id = $_GET['id'];
            $data = $viewModel->fetchOne($id);
            include 'views/pegawai_form.php';
        }
        break;

    case 'pegawai_delete': // Delete
        require_once 'viewmodels/PegawaiViewModel.php';
        $viewModel = new PegawaiViewModel();
        $id = $_GET['id'];
        $viewModel->remove($id);
        header("Location: index.php?page=pegawai_list");
        break;

    // ==========================================
    // MODULE: TRANSAKSI
    // ==========================================
    case 'transaksi_list':
        require_once 'viewmodels/TransaksiViewModel.php';
        $viewModel = new TransaksiViewModel();
        // Pastikan method di VM namanya getDaftarTransaksi() atau readAll() sesuai yg kamu buat
        $data = $viewModel->getDaftarTransaksi(); 
        include 'views/transaksi_list.php';
        break;
        
    case 'transaksi_form':
        require_once 'viewmodels/TransaksiViewModel.php';
        require_once 'viewmodels/PelangganViewModel.php';
        require_once 'viewmodels/LayananViewModel.php';

        $transaksiVM = new TransaksiViewModel();
        
        // Logic Simpan Transaksi
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $pelanggan = $_POST['id_pelanggan'];
            $layanan = $_POST['id_layanan'];
            $berat = $_POST['berat_kg'];
            
            if ($transaksiVM->tambahTransaksi($pelanggan, $layanan, $berat)) {
                header("Location: index.php?page=transaksi_list");
            } else {
                echo "Gagal transaksi!";
            }
        } else {
            // Kita butuh data Pelanggan & Layanan buat Dropdown di Form
            $pelangganVM = new PelangganViewModel();
            $layananVM = new LayananViewModel();
            
            $data_pelanggan = $pelangganVM->fetchAll();
            $data_layanan = $layananVM->fetchAll();
            
            include 'views/transaksi_form.php';
        }
        break;

        case 'transaksi_edit': // UPDATE
        require_once 'viewmodels/TransaksiViewModel.php';
        require_once 'viewmodels/PelangganViewModel.php';
        require_once 'viewmodels/LayananViewModel.php';

        $transaksiVM = new TransaksiViewModel();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proses Update
            $id = $_POST['id_transaksi'];
            $pelanggan = $_POST['id_pelanggan'];
            $layanan = $_POST['id_layanan'];
            $berat = $_POST['berat_kg'];
            
            // Panggil fungsi update (Nanti kita buat di VM)
            if ($transaksiVM->updateTransaksi($id, $pelanggan, $layanan, $berat)) {
                header("Location: index.php?page=transaksi_list");
            } else {
                echo "Gagal update transaksi!";
            }
        } else {
            // Tampilkan Form dengan Data Lama
            $id = $_GET['id'];
            $data = $transaksiVM->fetchOne($id); // Ambil data lama
            
            // Kita butuh data dropdown juga
            $pelangganVM = new PelangganViewModel();
            $layananVM = new LayananViewModel();
            $data_pelanggan = $pelangganVM->fetchAll();
            $data_layanan = $layananVM->fetchAll();
            
            include 'views/transaksi_form.php';
        }
        break;

    case 'transaksi_delete': // DELETE
        require_once 'viewmodels/TransaksiViewModel.php';
        $transaksiVM = new TransaksiViewModel();
        $id = $_GET['id'];
        $transaksiVM->deleteTransaksi($id);
        header("Location: index.php?page=transaksi_list");
        break;

    default:
        echo "<h3>Halaman tidak ditemukan!</h3>";
        break;
}

// --- Footer ---
// include 'views/template/footer.php'; 
?>