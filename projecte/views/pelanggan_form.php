<h3><?= isset($data) ? 'Edit Data Pelanggan' : 'Tambah Pelanggan Baru' ?></h3>

<form action="" method="POST">
    
    <?php if (isset($data['id_pelanggan'])): ?>
        <input type="hidden" name="id" value="<?= $data['id_pelanggan'] ?>">
    <?php endif; ?>

    <label>Nama Pelanggan:</label><br>
    <input type="text" name="nama" 
           value="<?= isset($data['nama_pelanggan']) ? $data['nama_pelanggan'] : '' ?>" 
           required><br>

    <label>Nomor HP:</label><br>
    <input type="text" name="no_hp" 
           value="<?= isset($data['no_hp']) ? $data['no_hp'] : '' ?>" 
           required><br>

    <label>Alamat:</label><br>
    <textarea name="alamat" rows="3"><?= isset($data['alamat']) ? $data['alamat'] : '' ?></textarea><br>

    <br>
    <button type="submit">Simpan Data</button>
    <a href="index.php?page=pelanggan_list">Batal</a>
</form>