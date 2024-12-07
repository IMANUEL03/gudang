<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Halaman Manajemen Data Barang Keluar
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<a href="/tambahbarangkeluar" class="btn btn-primary">
    Tambah Data
</a>
<?= $this->endSection('subjudul') ?>
<?= $this->section('isi') ?>

<table id="example2" class="table table-bordered">
    <thead class="text text-center">
        <tr>
            <th>No</th>
            <th>Peruntukan</th>
            <th>Tanggal Penyerahan</th>
            <th>Penerima</th>
            <th>Bukti Pengambilan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody class="text text-center">
        <?php $no = 1; ?>
        <?php foreach ($laporan as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['peruntukan']; ?></td>
                <td><?= $row['tanggal_penyerahan']; ?></td>
                <td><?= $row['penerima']; ?></td>
                <td>
                    <?php if (!empty($row['bukti_pengambilan'])) : ?>
                        <a href="./uploads/<?= $row['bukti_pengambilan']; ?>" class="btn btn-primary" download><?= $row['bukti_pengambilan']; ?> <i class="fa fa-file-pdf"></i></a>
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $row['id_barang_keluar']; ?>">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger" onclick="hapusBarangMasuk(<?= $row['id_barang_keluar']; ?>)">
                        Hapus
                    </button>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#detailModal<?= $row['id_barang_keluar']; ?>">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php foreach ($laporan as $row) : ?>
    <div class="modal fade" id="detailModal<?= $row['id_barang_keluar']; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $row['id_barang_keluar']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel<?= $row['id_barang_keluar']; ?>">Detail Barang Keluar</h5>
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
                                <th>Jumlah</th>
                                <th>kategori</th>
                                <th>Satuan</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text text-center">
                            <?php foreach ($row['detail_barang'] as $barang) : ?>
                                <tr>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <td><?= $barang['merek']; ?></td>
                                    <td><?= $barang['jumlah']; ?></td>
                                    <td><?= $barang['kategori']; ?></td>
                                    <td><?= $barang['satuan']; ?></td>
                                    <td><?= $barang['deskripsi']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" onclick="isiEditDetailModal(
        <?= $barang['id_rinc_keluar']; ?>,
        '<?= $barang['nama_barang']; ?>',
        '<?= $barang['merek']; ?>',
        <?= $barang['harga']; ?>,
        <?= $barang['jumlah']; ?>,
        '<?= $barang['kategori']; ?>',
        '<?= $barang['satuan']; ?>',
        '<?= $barang['deskripsi']; ?>'
    )">Edit</button>
                                        <button type="button" class="btn btn-danger" onclick="hapusDetailBarang(<?= $barang['id_rinc_keluar']; ?>)"> Hapus </button>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary tambahBarangBtn" data-id="<?= $row['id_barang_keluar']; ?>">Tambah Barang</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- edit modal -->
<?php foreach ($laporan as $row) : ?>
    <div class="modal fade" id="editModal<?= $row['id_barang_keluar']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id_barang_keluar']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row['id_barang_keluar']; ?>">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditBarang<?= $row['id_barang_keluar']; ?>">
                        <div class="form-group">
                            <label for="editperuntukan<?= $row['id_barang_keluar']; ?>">Peruntukan</label>
                            <input type="text" class="form-control" id="editperuntukan<?= $row['id_barang_keluar']; ?>" name="peruntukan" value="<?= $row['peruntukan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edittanggal_penyerahan<?= $row['id_barang_keluar']; ?>">Tanggal Penyerahan</label>
                            <input type="date" class="form-control" id="edittanggal_penyerahan<?= $row['id_barang_keluar']; ?>" name="tanggal_penyerahan" value="<?= $row['tanggal_penyerahan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editpenerima<?= $row['id_barang_keluar']; ?>">Penerima</label>
                            <input type="text" class="form-control" id="editpenerima<?= $row['id_barang_keluar']; ?>" name="penerima" value="<?= $row['penerima']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editbukti_pengambilan<?= $row['id_barang_keluar']; ?>">Bukti Pengambilan</label>
                            <input type="text" class="form-control" id="editbukti_pengambilan<?= $row['id_barang_keluar']; ?>" name="bukti_pengambilan" value="<?= $row['bukti_pengambilan']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editBarang(<?= $row['id_barang_keluar']; ?>)">Simpan</button>
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
                        <select class="form-control" id="nama_barang" name="nama_barang">
                            <option value="">Pilih Nama Barang</option>
                            <?php foreach ($inventories as $inventory) : ?>
                                <option value="<?= $inventory['nama_barang']; ?>"><?= $inventory['nama_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <input type="hidden" id="id_barang_keluar" name="id_barang_keluar">
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
                    <input type="hidden" id="edit_id_rinc_keluar" name="id_rinc_keluar">
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function editBarang(id) {
        var peruntukan = document.getElementById('editperuntukan' + id).value;
        var tanggal_penyerahan = document.getElementById('edittanggal_penyerahan' + id).value;
        var penerima = document.getElementById('editpenerima' + id).value;
        var bukti_pengambilan = document.getElementById('editbukti_pengambilan' + id).value;
        $.ajax({
            url: '/BarangKeluarController/editbarangkeluar/' + id,
            type: 'POST',
            data: {
                peruntukan: peruntukan,
                tanggal_penyerahan: tanggal_penyerahan,
                penerima: penerima,
                bukti_pengambilan: bukti_pengambilan
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
            url: '/BarangKeluarController/hapusbarangkeluar/' + id,
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
            var id_barang_keluar = $(this).data('id');
            $('#id_barang_keluar').val(id_barang_keluar);
            $('#tambahModal').modal('show');
        });
    });

    function simpanDataBarang() {
        var id_barang_keluar = $('#id_barang_keluar').val();
        var nama_barang = $('#nama_barang').val();
        var merek = $('#merek').val();
        var harga = $('#harga').val();
        var jumlah = $('#jumlah').val();
        var kategori = $('#kategori').val();
        var satuan = $('#satuan').val();
        var deskripsi = $('#deskripsi').val();

        $.ajax({
            url: '/tambahdetailbarangkeluar',
            type: 'POST',
            data: {
                id_barang_keluar: id_barang_keluar,
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

    function isiEditDetailModal(id_rinc_keluar, nama_barang, merek, harga, jumlah, kategori, satuan, deskripsi) {
        $('#edit_id_rinc_keluar').val(id_rinc_keluar);
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
        var id_rinc_keluar = $('#edit_id_rinc_keluar').val();
        var nama_barang = $('#edit_nama_barang').val();
        var merek = $('#edit_merek').val();
        var harga = $('#edit_harga').val();
        var jumlah = $('#edit_jumlah').val();
        var kategori = $('#edit_kategori').val();
        var satuan = $('#edit_satuan').val();
        var deskripsi = $('#edit_deskripsi').val();


        $.ajax({
            url: '/editDetailBarangKeluar', // Sesuaikan dengan rute yang ditetapkan di controller Anda
            type: 'POST',
            data: {
                id_rinc_keluar: id_rinc_keluar,
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

    function hapusDetailBarang(id_rinc_keluar) {
        if (confirm("Apakah Anda yakin ingin menghapus detail barang ini?")) {
            $.ajax({
                url: '/BarangKeluarController/hapusDetailBarangKeluar/' + id_rinc_keluar,
                type: 'POST',
                success: function(response) {
                    console.log(response);
                    // Reload halaman atau perbarui bagian yang sesuai setelah berhasil menghapus
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }
</script>

<?= $this->endSection('isi') ?>