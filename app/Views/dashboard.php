<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b><i class="fa fa-home"></i> Dashboard</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<i><b>Sistem Informasi Manajemen Barang Masuk Barang Keluar Gudang Bappenda</b></i>
<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<div class="row">
    <div class="col-md-6">
        <canvas id="myChart2" style="max-width: 550px; max-height: 350px;"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="myChart" style="max-width: 550px; max-height: 350px;"></canvas>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('LaporanBarangKeluarController/grafikBarangKeluarPerKategori') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var labels = [];
                var dataValues = [];

                data.forEach(function(item) {
                    labels.push(item.kategori);
                    dataValues.push(item.jumlah_barang);
                });

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Barang Keluar',
                            data: dataValues,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('LaporanBarangMasukController/grafikBarangMasukPerKategori') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var labels = [];
                var dataValues = [];

                data.forEach(function(item) {
                    labels.push(item.kategori);
                    dataValues.push(item.jumlah_barang);
                });

                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart2 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Barang Masuk',
                            data: dataValues,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection('isi') ?>