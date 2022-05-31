<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 200;
    include 'template/head.php';
?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Data Master Satuan Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                    <li class="breadcrumb-item active">Data Master Satuan Barang</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <a href="tambah-data-satuan-barang.php"><button type="button" class="btn btn-primary" name="button"><i class="fa fa-plus"></i> Tambah Satuan Barang</button></a>
                                <br><br>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">
                                                        <center>NO</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Satuan Barang</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Ubah</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Hapus</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = 'SELECT * FROM satuan_barang';
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {

                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['nama_satuan_barang'] . '</td>

                                                            <td align="center" style="">
                                                                <form class="" action="tambah-data-satuan-barang.php" method="GET">
                                                                    <input type="text" name="ubah" value="' . md5($row['id_satuan_barang']) . '" hidden>
                                                                    <button class="btn btn-primary btn-sm" type="submit" name=""><i class="fa fa-edit"></i></button>
                                                                </form>
                                                            </td>
                                                            <td align="center" style="">
                                                                <form class="" action="config/add-data-satuan-barang.php" method="GET">
                                                                <input type="text" name="delete" value="' . md5($row['id_satuan_barang']) . '" hidden>
                                                                <button class="btn btn-danger btn-sm" type="submit" name=""><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td></tr>
                                                            ';
                                                    }
                                                } else {
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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
        <?php include 'template/script.php';
        if (isset($_GET['tambah']) or isset($_GET['edit']) or isset($_GET['delete'])) {
            if ($_GET['tambah'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Satuan Baran berhasil ditambahkan.");
                    </script>
                    ';
            } elseif ($_GET['edit'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Satuan Baran berhasil diubah.");
                    </script>
                    ';
            } elseif ($_GET['delete'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Satuan Baran berhasil dihapus.");
                    </script>
                    ';
            } else {
                echo '
                    <script type="text/javascript">
                    toastr.error("Permintaan Anda gagal diproses.");
                    </script>
                    ';
            }
        } ?>
    </body>
<?php } ?>

</html>