<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Gudang Barang Masuk Dan Barang Keluar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
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


<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars accent-info"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-dark.bg-gradient">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>/Dashboard" class="brand-link">
                <img src="<?= base_url() ?>/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><b><i class="far">SISTEM INFORMASI GUDANG</i></b></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session('username') ?></a>
                    </div>

                </div>

                <!-- SidebarSearch Form -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/Dashboard" class="nav-link">
                                <i class="class=far fa fa-home nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Master Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/barang" class="nav-link">
                                        <i class="class=far fa fa-archive nav-icon"></i>
                                        <p>Data Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kategori" class="nav-link">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/supplier" class="nav-link">
                                        <i class="far fa fa-truck nav-icon"></i>
                                        <p>Supplier</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa fa-road"></i>
                                <p>
                                    Arus Barang
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/barangmasuk" class="nav-link">
                                        <i class="far fa fa-desktop nav-icon"></i>
                                        <p> Barang Masuk </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/barangkeluar" class="nav-link">
                                        <i class="fa fa-plane " aria-hidden="true"></i>
                                        <p>Barang Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa fa-file"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/laporanpenerimaan" class="nav-link">
                                        <i class="far fa fa-file nav-icon "></i>
                                        <p> Data Penerimaan Barang </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/laporanpengeluaran" class="nav-link">
                                        <i class="fa fa-file " aria-hidden="true"></i>
                                        <p>Laporan Pengeluaran Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kartudatabarang" class="nav-link">
                                        <i class="fa fa-file " aria-hidden="true"></i>
                                        <p>Kartu Data Barang</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <a href="/logout" class="nav-link">
                            <i class="fa fa-reply-all text-danger" aria-hidden="true"></i>
                            <p><b>Log Out</b></p>
                        </a>
                    </ul>
                </nav>
                <ul>
                    <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $this->renderSection('judul') ?></h1>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= $this->renderSection('subjudul') ?>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= $this->renderSection('isi') ?>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; IndraRajsya <a>Indra Rajsya</a></strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/dist/js/demo.js"></script>
</body>

</html>