<h3><?= isset($data) ? 'Edit Pegawai' : 'Tambah Pegawai Baru' ?></h3>

<form action="" method="POST">
    <?php if (isset($data['id_pegawai'])): ?>
        <input type="hidden" name="id" value="<?= $data['id_pegawai'] ?>">
    <?php endif; ?>

    <label>Nama Pegawai:</label><br>
    <input type="text" name="nama_pegawai" value="<?= isset($data['nama_pegawai']) ? $data['nama_pegawai'] : '' ?>" required><br>

    <label>Jabatan:</label><br>
    <select name="jabatan">
        <option value="Kasir" <?= (isset($data['jabatan']) && $data['jabatan'] == 'Kasir') ? 'selected' : '' ?>>Kasir</option>
        <option value="Pencuci" <?= (isset($data['jabatan']) && $data['jabatan'] == 'Pencuci') ? 'selected' : '' ?>>Pencuci</option>
        <option value="Setrika" <?= (isset($data['jabatan']) && $data['jabatan'] == 'Setrika') ? 'selected' : '' ?>>Bagian Setrika</option>
    </select><br>

    <br>
    <button type="submit">Simpan Pegawai</button>
    <a href="index.php?page=pegawai_list">Batal</a>
</form>