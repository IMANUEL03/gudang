<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Kartu Data Barang
<?= $this->endSection('judul') ?>
<?= $this->section('subjudul') ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<?= form_open('KartuDataBarangController/index', ['class' => 'form-inline']) ?>
<div class="form-group">
    <?= form_label('Filter Kategori:', 'kategori', ['class' => 'control-label']) ?>
    <?= form_dropdown('kategori', $kategori_options, set_value('kategori'), ['class' => 'form-control']) ?>
</div>
<div class="form-group">
    <?= form_submit('submit', 'Filter', ['class' => 'btn btn-primary']) ?>
    <a href="<?= base_url('KartuDataBarangController/exportToExcel?kategori=' . set_value('kategori')) ?>" class="btn btn-success">Export to Excel</a>
</div>
<?= form_close() ?>
<table id="example2" class="table table-bordered">
    <thead>
        <tr class="text text-center">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Merek</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>kategori</th>
            <th>Satuan</th>
            <th>Deskripsi</th>
            <th>Jumlah Total Harga</th>
        </tr>
    </thead>
    <tbody class="text text-center">
        <tr>
            <?php
            function hitungHarga($harga, $jumlah)
            {
                return $harga * $jumlah;
            }
            $no = 1; ?>
            <?php foreach ($barang as $row) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td><?= $row['merek']; ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td><?= $row['satuan']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td>Rp <?= number_format(hitungHarga($row['harga'], $row['jumlah']), 0, ',', '.'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tr>
    </tbody>
</table>


<?= $this->endSection('isi') ?>