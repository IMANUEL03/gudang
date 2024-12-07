<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Halaman Manajemen Data Kategori
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<table id="example2" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($kategori as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['namakategori']; ?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $row['id_kategori']; ?>">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger" onclick="hapusKategori(<?= $row['id_kategori']; ?>)">Hapus</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Modal Tambah -->

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
                <form id="formTambahKategori">
                    <div class="form-group">
                        <label for="namaKategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="namaKategori" name="namakategori">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitFormTambahKategori()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($kategori as $row) : ?>
    <div class="modal fade" id="editModal<?= $row['id_kategori']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id_kategori']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row['id_kategori']; ?>">Edit Data Jenis Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditKategori<?= $row['id_kategori']; ?>">
                        <div class="form-group">
                            <label for="editNamakategori<?= $row['id_kategori']; ?>">Nama Jenis Barang</label>
                            <input type="text" class="form-control" id="editNamaKategori<?= $row['id_kategori']; ?>" name="namakategori" value="<?= $row['namakategori']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editKategori(<?= $row['id_kategori']; ?>)">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function submitFormTambahKategori() {
        var namaKategori = $('#namaKategori').val();
        $.ajax({
            url: '/simpanKategori',
            type: 'POST',
            data: {
                namakategori: namaKategori
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

    function editKategori(id) {
        var namaKategori = document.getElementById('editNamaKategori' + id).value;
        $.ajax({
            url: '/updatekategori/' + id, // Sesuaikan dengan routes yang telah Anda definisikan
            type: 'POST',
            data: {
                namakategori: namaKategori
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

    function hapusKategori(id) {
        $.ajax({
            url: '/hapuskategori/' + id, // Sesuaikan dengan routes yang telah Anda definisikan
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