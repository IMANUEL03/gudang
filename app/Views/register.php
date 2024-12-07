<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">

    <style>
        /* Warna latar belakang header */
        .main-header {
            background-color: #333;
            color: white;
        }

        /* Warna latar belakang body */
        body {
            background-color: #f4f4f4;
            color: #333;
        }

        /* Warna latar belakang header kartu */
        .card-header {
            background-color: #333;
            color: white;
        }

        /* Warna latar belakang badan kartu */
        .card-body {
            background-color: #fff;
            color: #333;
        }

        /* Warna latar belakang konten */
        .content {
            background-color: #fff;
            color: #333;
        }

        /* Warna latar belakang wrapper konten */
        .content-wrapper {
            background-color: #fff;
            color: #333;
        }

        /* CSS untuk mengubah warna latar belakang sidebar */
        .sidebar-dark-primary {
            background-color: #222;
            color: white;
        }

        /* CSS untuk mengubah warna latar belakang footer */
        .main-footer {
            background-color: #222;
            color: white;
        }

        /* CSS untuk mengubah warna latar belakang navbar */
        .navbar-dark {
            background-color: #222;
            color: white;
        }

        /* CSS untuk mengubah warna latar belakang halaman registrasi */
        .register-page {
            background-color: #222;
            color: white;

        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>

</head>

<body class="register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>SIGUDANG</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg"><b><i>Register Page</i></b></p>

                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>



                <form action="<?= base_url('RegisterController/register') ?>" method="post">
                    <label for="username">Username</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Required" name="username" value="<?= old('username') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label for="password">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Required" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <label for="nama">Nama Lengkap</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?= old('nama') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label for="nip">NIP</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nip" name="nip" value="<?= old('nip') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label for="nip">Bidang</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Bidang" name="bidang" value="<?= old('bidang') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label for="nip">Jabatan</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Jabatan" name="jabatan" value="<?= old('jabatan') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="<?= base_url('/') ?>" class="text-center"><b>Login</b></a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
</body>

</html>