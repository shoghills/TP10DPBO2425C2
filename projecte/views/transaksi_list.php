<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi Laundry</title>
    <style>
        /* Sedikit styling biar rapi */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; background: #eee; border: 1px solid #ccc; color: black;}
    </style>
</head>
<body>
    <h2>Daftar Transaksi</h2>
    <a href="index.php?page=transaksi_form" class="btn">+ Tambah Transaksi</a>
    <br><br>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Berat (Kg)</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // PERBAIKAN DISINI:
            // Kita langsung pakai variabel $data yang dikirim dari index.php
            // Tidak perlu memanggil $viewmodel->getDaftarTransaksi() lagi.
            
            if ($data) {
                $no = 1;
                while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama_pelanggan'] . "</td>";
                    echo "<td>" . $row['nama_layanan'] . "</td>";
                    echo "<td>" . $row['berat_kg'] . " kg</td>";
                    echo "<td>Rp " . number_format($row['total_bayar'], 0, ',', '.') . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    // Cek jika ada kolom tanggal (opsional jika di query ada)
                    $tgl = isset($row['tanggal_transaksi']) ? $row['tanggal_transaksi'] : '-';
                    echo "<td>" . $tgl . "</td>";
                    echo "<td>";
                    echo "<a href='index.php?page=transaksi_edit&id=" . $row['id_transaksi'] . "'>Edit</a> | ";
                    echo "<a href='index.php?page=transaksi_delete&id=" . $row['id_transaksi'] . "' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>";
                    echo "</td>";
                    
                    echo "</tr>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Belum ada data transaksi.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>