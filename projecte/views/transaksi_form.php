<h3><?= isset($data) ? 'Edit Transaksi' : 'Tambah Transaksi Laundry' ?></h3>

<form action="" method="POST">
    
    <?php if (isset($data['id_transaksi'])): ?>
        <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">
    <?php endif; ?>

    <label>Pilih Pelanggan:</label><br>
    <select name="id_pelanggan" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php foreach ($data_pelanggan as $plg): ?>
            <option value="<?= $plg['id_pelanggan'] ?>" 
                <?= (isset($data['id_pelanggan']) && $data['id_pelanggan'] == $plg['id_pelanggan']) ? 'selected' : '' ?>>
                <?= $plg['nama_pelanggan'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Pilih Jenis Layanan:</label><br>
    <select name="id_layanan" required>
        <option value="">-- Pilih Layanan --</option>
        <?php foreach ($data_layanan as $lyn): ?>
            <option value="<?= $lyn['id_layanan'] ?>"
                <?= (isset($data['id_layanan']) && $data['id_layanan'] == $lyn['id_layanan']) ? 'selected' : '' ?>>
                <?= $lyn['nama_layanan'] ?> (Rp <?= number_format($lyn['harga_per_kg']) ?>/kg)
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Berat Cucian (Kg):</label><br>
    <input type="number" step="0.1" name="berat_kg" required 
           value="<?= isset($data['berat_kg']) ? $data['berat_kg'] : '' ?>" 
           placeholder="Contoh: 3.5"><br>

    <br>
    <button type="submit">Simpan Transaksi</button>
    <a href="index.php?page=transaksi_list">Batal</a>
</form>