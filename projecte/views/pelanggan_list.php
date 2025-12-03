<h3>Data Pelanggan</h3>
<a href="index.php?page=pelanggan_form"><button>+ Tambah Pelanggan</button></a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id_pelanggan'] ?></td>
            <td><?= $row['nama_pelanggan'] ?></td>
            <td><?= $row['no_hp'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td>
                <a href="index.php?page=pelanggan_edit&id=<?= $row['id_pelanggan'] ?>">Edit</a> | 
                <a href="index.php?page=pelanggan_delete&id=<?= $row['id_pelanggan'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>