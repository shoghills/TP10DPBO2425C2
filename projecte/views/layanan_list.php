<h3>Data Layanan</h3>
<a href="index.php?page=layanan_form"><button>+ Tambah Layanan</button></a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Layanan</th>
            <th>Harga per Kg</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id_layanan'] ?></td>
            <td><?= $row['nama_layanan'] ?></td>
            <td>Rp <?= number_format($row['harga_per_kg'], 0, ',', '.') ?></td>
            <td>
                <a href="index.php?page=layanan_edit&id=<?= $row['id_layanan'] ?>">Edit</a> | 
                <a href="index.php?page=layanan_delete&id=<?= $row['id_layanan'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>