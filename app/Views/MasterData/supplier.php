<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Halaman Manajemen Data Supplier
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<table id="example2" class="table table-bordered">
    <thead>
        <tr class="text text-center">
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody class="text text-center">
        <tr>
            <?php

            $no = 1; ?>
            <?php foreach ($supplier as $row) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_supplier']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['kontak']; ?></td>
            <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $row['id_supplier']; ?>">
                    Edit
                </button>
                <button type="button" class="btn btn-danger" onclick="hapusSupplier(<?= $row['id_supplier']; ?>)">Hapus</button>
            </td>

        </tr>
    <?php endforeach; ?>
    </tr>
    </tbody>
</table>

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahSupplier">
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" class="form-control" id="kontak" name="kontak">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="submitFormTambahSupplier()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($supplier as $row) : ?>
    <div class="modal fade" id="editModal<?= $row['id_supplier']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id_supplier']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row['id_supplier']; ?>">Edit Data Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditSupplier<?= $row['id_supplier']; ?>">
                        <div class="form-group">
                            <label for="editNamaSupplier<?= $row['id_supplier']; ?>">Nama Supplier</label>
                            <input type="text" class="form-control" id="editNamaSupplier<?= $row['id_supplier']; ?>" name="nama_supplier" value="<?= $row['nama_supplier']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editAlamat<?= $row['id_supplier']; ?>">Alamat</label>
                            <input type="text" class="form-control" id="editAlamat<?= $row['id_supplier']; ?>" name="alamat" value="<?= $row['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editKontak<?= $row['id_supplier']; ?>">Kontak</label>
                            <input type="text" class="form-control" id="editKontak<?= $row['id_supplier']; ?>" name="kontak" value="<?= $row['kontak']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editSupplier(<?= $row['id_supplier']; ?>)">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function submitFormTambahSupplier() {
        var nama_supplier = $('#nama_supplier').val();
        var alamat = $('#alamat').val();
        var kontak = $('#kontak').val();
        $.ajax({
            url: '/simpansupplier',
            type: 'POST',
            data: {
                nama_supplier: nama_supplier,
                alamat: alamat,
                kontak: kontak
            },
            success: function(response) {
                console.log(response);
                $('#tambahModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function editSupplier(id) {
        var namaSupplier = document.getElementById('editNamaSupplier' + id).value;
        var alamat = document.getElementById('editAlamat' + id).value;
        var kontak = document.getElementById('editKontak' + id).value;
        $.ajax({
            url: '/updatesupplier/' + id,
            type: 'POST',
            data: {
                nama_supplier: namaSupplier,
                alamat: alamat,
                kontak: kontak
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

    function hapusSupplier(id) {
        $.ajax({
            url: '/hapussupplier/' + id,
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