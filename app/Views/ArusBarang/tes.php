<!-- detail.php -->
<h1>Detail Barang Masuk</h1>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Spk</th>
            <th>Tanggal Spk</th>
            <th>Nomor BA Penerimaan</th>
            <th>Tanggal BA Penerimaan</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($barangs as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['no_spk']; ?></td>
                <td><?= $row['tgl_spk']; ?></td>
                <td><?= $row['no_ba_penerimaan']; ?></td>
                <td><?= $row['tgl_ba_penerimaan']; ?></td>
                <td><?= $row['supplier']; ?></td>
            <?php endforeach; ?>

            <!-- Tampilkan semua data barang -->
            <h2>Daftar Barang:</h2>
            <ul>
                <?php foreach ($barangMasuk['barangs'] as $barang) : ?>
                    <li><?= $barang['nama_barang'] ?></li>
                <?php endforeach; ?>
            </ul>