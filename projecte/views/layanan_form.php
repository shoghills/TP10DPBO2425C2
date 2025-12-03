<h3><?= isset($data) ? 'Edit Layanan' : 'Tambah Layanan Baru' ?></h3>

<form action="" method="POST">
    <?php if (isset($data['id_layanan'])): ?>
        <input type="hidden" name="id" value="<?= $data['id_layanan'] ?>">
    <?php endif; ?>

    <label>Nama Layanan:</label><br>
    <input type="text" name="nama_layanan" value="<?= isset($data['nama_layanan']) ? $data['nama_layanan'] : '' ?>" required placeholder="Contoh: Cuci Komplit"><br>

    <label>Harga per Kg:</label><br>
    <input type="number" name="harga_per_kg" value="<?= isset($data['harga_per_kg']) ? $data['harga_per_kg'] : '' ?>" required placeholder="Contoh: 7000"><br>

    <br>
    <button type="submit">Simpan Layanan</button>
    <a href="index.php?page=layanan_list">Batal</a>
</form>