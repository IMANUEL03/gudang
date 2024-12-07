<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

</body>
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Merek</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Jenis</th>
            <th>Satuan</th>
            <th>Deskripsi</th>
            <th>Jumlah Total Harga</th>
        </tr>
    </thead>
    <tbody>
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
            <td><?= $row['jenis']; ?></td>
            <td><?= $row['satuan']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td>Rp <?= number_format(hitungHarga($row['harga'], $row['jumlah']), 0, ',', '.'); ?></td>

        </tr>
    <?php endforeach; ?>
    </tr>
    </tbody>
</table>

</html>