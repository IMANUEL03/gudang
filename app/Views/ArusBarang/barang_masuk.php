<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Halaman Manajemen Data Barang Masuk
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<a href="/tambahbarangmasuk" class="btn btn-primary">
    Tambah Data
</a>
<?= $this->endSection('subjudul') ?>
<?= $this->section('isi') ?>

<table id="example2" class="table table-bordered">
    <thead class="text text-center">
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
    <tbody class="text text-center">
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
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $row['id_barang_masuk']; ?>">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger" onclick="hapusBarangMasuk(<?= $row['id_barang_masuk']; ?>)">
                        Hapus
                    </button>
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
                        <thead class="text text-center">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merek</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>kategori</th>
                                <th>Satuan</th>
                                <th>Total Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text text-center">
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
                                    <td>
                                        <button type="button" class="btn btn-warning" onclick="isiEditDetailModal(
        <?= $barang['id_barang']; ?>,
        '<?= $barang['nama_barang']; ?>',
        '<?= $barang['merek']; ?>',
        <?= $barang['harga']; ?>,
        <?= $barang['jumlah']; ?>,
        '<?= $barang['kategori']; ?>',
        '<?= $barang['satuan']; ?>',
        '<?= $barang['deskripsi']; ?>'
    )">Edit</button>
                                        <button type="button" class="btn btn-danger" onclick="hapusDetailBarang(<?= $barang['id_barang']; ?>)"> Hapus </button>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary tambahBarangBtn" data-id="<?= $row['id_barang_masuk']; ?>">Tambah Barang</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal tambah detail data -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah data barang -->
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
                        <input type="number" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
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
                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <input type="hidden" id="id_barang_masuk" name="id_barang_masuk">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanDataBarang()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit detail modal -->
<div class="modal fade" id="editDetailModal" tabindex="-1" aria-labelledby="editDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDetailModalLabel">Edit Detail Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditDetailBarang">
                    <input type="hidden" id="edit_id_barang" name="id_barang">
                    <div class="form-group">
                        <label for="edit_nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang">
                    </div>
                    <div class="form-group">
                        <label for="edit_merek">Merek</label>
                        <input type="text" class="form-control" id="edit_merek" name="merek">
                    </div>
                    <div class="form-group">
                        <label for="edit_harga">Harga</label>
                        <input type="number" class="form-control" id="edit_harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="edit_jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="edit_jumlah" name="jumlah">
                    </div>
                    <div class="form-group">
                        <label for="edit_kategori">Kategori</label>
                        <input type="text" class="form-control" id="edit_kategori" name="kategori">
                    </div>
                    <div class="form-group">
                        <label for="edit_satuan">Satuan</label>
                        <input type="text" class="form-control" id="edit_satuan" name="satuan">
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanEditDetailBarang()">Simpan</button>
            </div>
        </div>
    </div>
</div>


<!-- edit modal -->
<?php foreach ($laporan as $row) : ?>
    <div class="modal fade" id="editModal<?= $row['id_barang_masuk']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id_barang_masuk']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row['id_barang_masuk']; ?>">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditBarang<?= $row['id_barang_masuk']; ?>">
                        <div class="form-group">
                            <label for="editno_spk<?= $row['id_barang_masuk']; ?>">Nomor SPK</label>
                            <input type="text" class="form-control" id="editno_spk<?= $row['id_barang_masuk']; ?>" name="no_spk" value="<?= $row['no_spk']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edittgl_spk<?= $row['id_barang_masuk']; ?>">Tanggal SPK</label>
                            <input type="date" class="form-control" id="edittgl_spk<?= $row['id_barang_masuk']; ?>" name="tgl_spk" value="<?= $row['tgl_spk']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editno_ba_penerimaan<?= $row['id_barang_masuk']; ?>">Nomor BA Penerimaan</label>
                            <input type="text" class="form-control" id="editno_ba_penerimaan<?= $row['id_barang_masuk']; ?>" name="no_ba_penerimaan" value="<?= $row['no_ba_penerimaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edittgl_ba_penerimaan<?= $row['id_barang_masuk']; ?>">Tanggal BA Penerimaan</label>
                            <input type="date" class="form-control" id="edittgl_ba_penerimaan<?= $row['id_barang_masuk']; ?>" name="tgl_ba_penerimaan" value="<?= $row['tgl_ba_penerimaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editsupplier<?= $row['id_barang_masuk']; ?>">Supplier</label>
                            <input type="text" class="form-control" id="editsupplier<?= $row['id_barang_masuk']; ?>" name="supplier" value="<?= $row['supplier']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editBarang(<?= $row['id_barang_masuk']; ?>)">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function editBarang(id) {
        var no_spk = document.getElementById('editno_spk' + id).value;
        var tgl_spk = document.getElementById('edittgl_spk' + id).value;
        var no_ba_penerimaan = document.getElementById('editno_ba_penerimaan' + id).value;
        var tgl_ba_penerimaan = document.getElementById('edittgl_ba_penerimaan' + id).value;
        var supplier = document.getElementById('editsupplier' + id).value;
        $.ajax({
            url: '/editbarangmasuk/' + id,
            type: 'POST',
            data: {
                no_spk: no_spk,
                tgl_spk: tgl_spk,
                no_ba_penerimaan: no_ba_penerimaan,
                tgl_ba_penerimaan: tgl_ba_penerimaan,
                supplier: supplier
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

    function hapusBarangMasuk(id) {

        $.ajax({
            url: '/BarangMasukController/hapusbarangmasuk/' + id,
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

    $(document).ready(function() {
        $('.tambahBarangBtn').click(function() {
            var id_barang_masuk = $(this).data('id');
            $('#id_barang_masuk').val(id_barang_masuk);
            $('#tambahModal').modal('show');
        });
    });

    function simpanDataBarang() {
        var id_barang_masuk = $('#id_barang_masuk').val();
        var nama_barang = $('#nama_barang').val();
        var merek = $('#merek').val();
        var harga = $('#harga').val();
        var jumlah = $('#jumlah').val();
        var kategori = $('#kategori').val();
        var satuan = $('#satuan').val();
        var deskripsi = $('#deskripsi').val();

        $.ajax({
            url: '/tambahdetailbarang',
            type: 'POST',
            data: {
                id_barang_masuk: id_barang_masuk,
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
                $('#tambahModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function isiEditDetailModal(id_barang, nama_barang, merek, harga, jumlah, kategori, satuan, deskripsi) {
        $('#edit_id_barang').val(id_barang);
        $('#edit_nama_barang').val(nama_barang);
        $('#edit_merek').val(merek);
        $('#edit_harga').val(harga);
        $('#edit_jumlah').val(jumlah);
        $('#edit_kategori').val(kategori);
        $('#edit_satuan').val(satuan);
        $('#edit_deskripsi').val(deskripsi);
        $('#editDetailModal').modal('show');
    }

    // Fungsi untuk menyimpan edit detail barang
    function simpanEditDetailBarang() {
        var id_barang = $('#edit_id_barang').val();
        var nama_barang = $('#edit_nama_barang').val();
        var merek = $('#edit_merek').val();
        var harga = $('#edit_harga').val();
        var jumlah = $('#edit_jumlah').val();
        var kategori = $('#edit_kategori').val();
        var satuan = $('#edit_satuan').val();
        var deskripsi = $('#edit_deskripsi').val();


        $.ajax({
            url: '/editDetailBarang', // Sesuaikan dengan rute yang ditetapkan di controller Anda
            type: 'POST',
            data: {
                id_barang: id_barang,
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
                $('#editDetailModal').modal('hide');
                location.reload(); // Reload halaman setelah berhasil menyimpan edit
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function hapusDetailBarang(id_barang) {
        if (confirm("Apakah Anda yakin ingin menghapus detail barang ini?")) {
            $.ajax({
                url: '/hapusDetailBarangMasuk/' + id_barang, // Sesuaikan dengan rute yang ditetapkan di controller Anda
                type: 'POST',
                success: function(response) {
                    console.log(response);
                    // Reload halaman atau perbarui bagian yang sesuai setelah berhasil menghapus
                    location.reload(); // Contoh: reload halaman setelah berhasil menghapus
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
</script>
<?= $this->endSection('isi') ?>