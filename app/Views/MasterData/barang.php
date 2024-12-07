<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Halaman Manajemen Data Barang
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<button class="fa fa-search"></button>
<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

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
            <th>Aksi</th>
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
            <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $row['id_inventory']; ?>">
                    Edit
                </button>
                <button type="button" class="btn btn-danger" onclick="hapusBarang(<?= $row['id_inventory']; ?>)">Hapus</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tr>
    </tbody>
</table>

<!-- modal edit  -->
<?php foreach ($barang as $row) : ?>
    <div class="modal fade" id="editModal<?= $row['id_inventory']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id_inventory']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row['id_inventory']; ?>">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditBarang<?= $row['id_inventory']; ?>">
                        <div class="form-group">
                            <label for="editnama_barang<?= $row['id_inventory']; ?>">Nama Barang</label>
                            <input type="text" class="form-control" id="editnama_barang<?= $row['id_inventory']; ?>" name="nama_barang" value="<?= $row['nama_barang']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_merek<?= $row['id_inventory']; ?>">Merek</label>
                            <input type="text" class="form-control" id="edit_merek<?= $row['id_inventory']; ?>" name="merek" value="<?= $row['merek']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_harga<?= $row['id_inventory']; ?>">Harga</label>
                            <input type="text" class="form-control" id="edit_harga<?= $row['id_inventory']; ?>" name="harga" value="<?= $row['harga']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_jumlah<?= $row['id_inventory']; ?>">Jumlah</label>
                            <input type="text" class="form-control" id="edit_jumlah<?= $row['id_inventory']; ?>" name="jumlah" value="<?= $row['jumlah']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_kategori<?= $row['id_inventory']; ?>">kategori</label>
                            <input type="text" class="form-control" id="edit_kategori<?= $row['id_inventory']; ?>" name="kategori" value="<?= $row['kategori']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_satuan<?= $row['id_inventory']; ?>">Satuan</label>
                            <input type="text" class="form-control" id="edit_satuan<?= $row['id_inventory']; ?>" name="satuan" value="<?= $row['satuan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_deskripsi<?= $row['id_inventory']; ?>">Deskripsi</label>
                            <input type="text" class="form-control" id="edit_deskripsi<?= $row['id_inventory']; ?>" name="deskripsi" value="<?= $row['deskripsi']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editBarang(<?= $row['id_inventory']; ?>)">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function editBarang(id) {
        var nama_barang = document.getElementById('editnama_barang' + id).value;
        var merek = document.getElementById('edit_merek' + id).value;
        var harga = document.getElementById('edit_harga' + id).value;
        var jumlah = document.getElementById('edit_jumlah' + id).value;
        var kategori = document.getElementById('edit_kategori' + id).value;
        var satuan = document.getElementById('edit_satuan' + id).value;
        var deskripsi = document.getElementById('edit_deskripsi' + id).value;
        $.ajax({
            url: '/updateBarang/' + id,
            type: 'POST',
            data: {
                nama_barang: nama_barang,
                merek: merek,
                harga: harga,
                jumlah: jumlah,
                kategori: kategori,
                satuan: satuan,
                deskripsi: deskripsi
            },
            success: function(response) {
                console.log(response);
                $('#editModal' + id).modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function hapusBarang(id) {
        $.ajax({
            url: '/hapusBarang/' + id,
            type: 'POST',
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
<?= $this->endSection('isi') ?>