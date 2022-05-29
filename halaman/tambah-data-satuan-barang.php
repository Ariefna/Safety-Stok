<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 0;
    include 'template/head.php';
    ?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['ubah'])) {
                    $sql = 'SELECT * FROM satuan_barang WHERE md5(id_satuan_barang)="' . $_GET['ubah'] . '"';
                    $i = 1;
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $id_satuan_barang        = $row['id_satuan_barang'];
                            $nama_satuan_barang      = $row['nama_satuan_barang'];

                        }
                    } else { }
                } else {

                    $id_satuan_barang        = 0;
                    $nama_satuan_barang      = "";

                }
                ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Tambah Data Satuan Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                    <li class="breadcrumb-item"><a href="menu-data-jenis-barang.php">Data Satuan Barang</a></li>
                                    <li class="breadcrumb-item active">Tambah Data Satuan Barang</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <form class="" action="config/add-data-satuan-barang.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Satuan Barang</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="" placeholder="ID Satuan Barang .." name="id_satuan_barang" value="<?php echo $id_satuan_barang; ?>" hidden required>
                                                    <input type="text" class="form-control" id="" placeholder="Masukkan Satuan Barang .." name="nama_satuan_barang" value="<?php echo $nama_satuan_barang; ?>" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                                        </div>
                                    </form>

                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. container-fluid -->
                </section>

                <!-- Main content -->

                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include 'template/footer.php';; ?>

            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <?php include 'template/script.php'; ?>

    </body>
<?php } ?>

</html>
