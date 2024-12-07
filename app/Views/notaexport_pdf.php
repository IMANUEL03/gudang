<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Barang Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Nota Barang Keluar</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th>Jumlah</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
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
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td><?= $row['satuan']; ?></td>
                    <td><?= $row['deskripsi']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>