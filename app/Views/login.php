<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGUDANG BAPPENDA</title>

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

        /* Warna latar belakang sidebar */
        .sidebar-dark-primary {
            background-color: #222;
            color: white;
        }

        /* Warna latar belakang footer */
        .main-footer {
            background-color: #222;
            color: white;
        }

        /* Warna latar belakang navbar */
        .navbar-dark {
            background-color: #222;
            color: white;
        }

        /* Warna latar belakang konten modal */
        .modal-content {
            background-color: #fff;
            color: #333;
        }

        /* Warna latar belakang header konten */
        .content-header {
            background-color: #222;
            color: white;
        }
    </style>


</head>

<body class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url('index2.html') ?>" class="h1"><b>SIGUDANG</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg"><i><b>Sign In Page</b></i></p>
                <?php if (session()->has('message')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session('message') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('LoginController/login') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="UserName" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><i>Sign In</i></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="<?= base_url('/register') ?>" class="text-center">Register</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
</body>

</html>