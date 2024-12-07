<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Buku Penerimaan Barang
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<?php if (!empty($laporan)) : ?>
    <div class="mb-3">
        <a href="<?= base_url('LaporanBarangMasukController/exportPenerimaanExcel'); ?>" class="btn btn-success">Export to Excel</a>
    </div>
<?php endif; ?>
<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<!-- Form untuk filter -->
<form method="post" action="<?= base_url('LaporanBarangMasukController/penerimaanBarang') ?>">
    <div class="form-group">
        <label for="bulan">Bulan:</label>
        <select name="bulan" id="bulan" class="form-control">
            <option value="">Pilih Bulan</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tahun">Tahun:</label>
        <select name="tahun" id="tahun" class="form-control">
            <option value="">Pilih Tahun</option>
            <?php for ($i = 2020; $i <= 2999; $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="kategori">Kategori:</label>
        <select name="kategori" id="kategori" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori_barang as $kategori) : ?>
                <option value="<?= $kategori['kategori'] ?>"><?= $kategori['kategori'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>


<table id="example2" class="table table-bordered">
    <thead>
        <h5>Laporan Barang Masuk</h5>
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
        <?php foreach ($laporan as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['no_spk']; ?></td>
                <td><?= $row['tgl_spk']; ?></td>
                <td><?= $row['no_ba_penerimaan']; ?></td>
                <td><?= $row['tgl_ba_penerimaan']; ?></td>
                <td><?= $row['supplier']; ?></td>
                <td>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#detailModal<?= $row['id_barang_masuk']; ?>">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- detail modal -->
<?php foreach ($laporan as $row) : ?>
    <div class="modal fade" id="detailModal<?= $row['id_barang_masuk']; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $row['id_barang_masuk']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel<?= $row['id_barang_masuk']; ?>">Detail Barang Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merek</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>kategori</th>
                                <th>Satuan</th>
                                <th>Total Harga</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row['detail_barang'] as $barang) : ?>
                                <tr>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <td><?= $barang['merek']; ?></td>
                                    <td>Rp <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                                    <td><?= $barang['jumlah']; ?></td>
                                    <td><?= $barang['kategori']; ?></td>
                                    <td><?= $barang['satuan']; ?></td>
                                    <td>Rp<?= number_format($barang['harga'] * $barang['jumlah'], 0, ',', '.'); ?></td>
                                    <td><?= $barang['deskripsi']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?= $this->endSection('isi') ?>