<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Halaman Manajemen Data Barang Masuk
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<a href="/barangmasuk" class="btn btn-warning">
    <i class="fa fa-backward">Kembali</i>
</a>
<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="/simpanbarangmasuk" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_spk">Nomor SPK:</label>
                            <input type="text" class="form-control" id="no_spk" name="no_spk">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_spk">Tanggal SPK:</label>
                            <input type="date" class="form-control" id="tgl_spk" name="tgl_spk">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_ba_penerimaan">Nomor BA Penerimaan:</label>
                            <input type="text" class="form-control" id="no_ba_penerimaan" name="no_ba_penerimaan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_ba_penerimaan">Tanggal BA Penerimaan:</label>
                            <input type="date" class="form-control" id="tgl_ba_penerimaan" name="tgl_ba_penerimaan">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="supplier">Supplier:</label>
                            <select class="form-control" id="supplier" name="supplier">
                                <?php foreach ($suppliers as $supplier) : ?>
                                    <option value="<?= $supplier['nama_supplier']; ?>"><?= $supplier['nama_supplier']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div>
                <div>
                    <label for="">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>
                    </label>
                </div>
            </div>
            <label for="">Nota Barang Masuk</label>
            <table id="example2" class="table table-bordered">
                <thead class="text text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Merek</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>kategori</th>
                        <th>Satuan</th>
                        <th>Deskripsi</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text text-center">
                    <?php
                    function hitungHarga($harga, $jumlah)
                    {
                        return $harga * $jumlah;
                    }
                    $no = 1;
                    foreach ($barang as $row) : ?>
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
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $row['id_barang']; ?>">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger" onclick="hapusBarang(<?= $row['id_barang']; ?>)">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- modal tambah nota -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/BarangMasukController/tambahnota">
                    <form id="formTambahBarang">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                        </div>
                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input type="text" class="form-control" id="merek" name="merek">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="kategori">kategori</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <?php foreach ($kategori as $row) : ?>
                                    <option value="<?= $row['namakategori']; ?>"><?= $row['namakategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="submitFormTambahBarang()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- modal edit Nota -->
<?php foreach ($barang as $row) : ?>
    <div class="modal fade" id="editModal<?= $row['id_barang']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id_barang']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row['id_barang']; ?>">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditBarang<?= $row['id_barang']; ?>">
                        <div class="form-group">
                            <label for="editnama_barang<?= $row['id_barang']; ?>">Nama Barang</label>
                            <input type="text" class="form-control" id="editnama_barang<?= $row['id_barang']; ?>" name="nama_barang" value="<?= $row['nama_barang']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_merek<?= $row['id_barang']; ?>">Merek</label>
                            <input type="text" class="form-control" id="edit_merek<?= $row['id_barang']; ?>" name="merek" value="<?= $row['merek']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_harga<?= $row['id_barang']; ?>">Harga</label>
                            <input type="text" class="form-control" id="edit_harga<?= $row['id_barang']; ?>" name="harga" value="<?= $row['harga']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_jumlah<?= $row['id_barang']; ?>">Jumlah</label>
                            <input type="text" class="form-control" id="edit_jumlah<?= $row['id_barang']; ?>" name="jumlah" value="<?= $row['jumlah']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_kategori<?= $row['id_barang']; ?>">kategori</label>
                            <input type="text" class="form-control" id="edit_kategori<?= $row['id_barang']; ?>" name="kategori" value="<?= $row['kategori']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_satuan<?= $row['id_barang']; ?>">Satuan</label>
                            <input type="text" class="form-control" id="edit_satuan<?= $row['id_barang']; ?>" name="satuan" value="<?= $row['satuan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_deskripsi<?= $row['id_barang']; ?>">Deskripsi</label>
                            <input type="text" class="form-control" id="edit_deskripsi<?= $row['id_barang']; ?>" name="deskripsi" value="<?= $row['deskripsi']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editBarang(<?= $row['id_barang']; ?>)">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function submitFormTambahBarang() {
        var nama_barang = $('#nama_barang').val();
        var merek = $('#merek').val();
        var harga = $('#harga').val();
        var jumlah = $('#jumlah').val();
        var kategori = $('#kategori').val();
        var satuan = $('#satuan').val();
        var deskripsi = $('#deskripsi').val();
        $.ajax({
            url: '/BarangMasukController/tambahnota',
            type: 'POST',
            data: {
                nama_barang: nama_barang,
                merek: merek,
                harga: harga,
                jumlah: jumlah,
                kategori: kategori,
                satuan: satuan,
                deskripsi: deskripsi,
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

    function editBarang(id) {
        var nama_barang = document.getElementById('editnama_barang' + id).value;
        var merek = document.getElementById('edit_merek' + id).value;
        var harga = document.getElementById('edit_harga' + id).value;
        var jumlah = document.getElementById('edit_jumlah' + id).value;
        var kategori = document.getElementById('edit_kategori' + id).value;
        var satuan = document.getElementById('edit_satuan' + id).value;
        var deskripsi = document.getElementById('edit_deskripsi' + id).value;
        $.ajax({
            url: '/editnota/' + id,
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
            url: '/BarangMasukController/hapusnota/' + id,
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