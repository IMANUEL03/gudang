<?= $this->extend('main/layout') ?>
<?= $this->section('judul') ?>
Halaman Laporan Pengeluaran Barang
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<?php if (!empty($laporan)) : ?>
    <div class="mb-3">
        <a href="<?= base_url('LaporanBarangKeluarController/exportPenerimaanExcel'); ?>" class="btn btn-success">Export to Excel</a>
    </div>
<?php endif; ?>
<?= $this->endSection('subjudul') ?>
<?= $this->section('isi') ?>
<form action="/LaporanBarangKeluarController/pengeluaranbarang" method="post">
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
    <!-- Tambahkan form select untuk kategori -->
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