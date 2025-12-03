<h3>Data Pegawai</h3>
<a href="index.php?page=pegawai_form"><button>+ Tambah Pegawai</button></a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th> <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id_pegawai'] ?></td>
            <td><?= $row['nama_pegawai'] ?></td>
            
            <td><?= $row['jabatan'] ?></td>
            
            <td>
                <a href="index.php?page=pegawai_edit&id=<?= $row['id_pegawai'] ?>">Edit</a> | 
                <a href="index.php?page=pegawai_delete&id=<?= $row['id_pegawai'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>