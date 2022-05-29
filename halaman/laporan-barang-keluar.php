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
                                <h1>Laporan Barang Keluar</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Laporan Barang Keluar</li>
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
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">
                                                        <center>NO</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th>
                                                        <center>File</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = 'SELECT * FROM peminjaman_barang
                                                    WHERE status_peminjaman = 1';
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_peminjaman'] == 0) {
                                                                $verifikasi = '<span class="right badge badge-warning">Panding</span>';
                                                            } elseif ($row['status_peminjaman'] == 1) {
                                                                $verifikasi = '<span class="right badge badge-success">Approved</span>';
                                                            } else {
                                                                $verifikasi = '<span class="right badge badge-danger">Not approved</span>';
                                                            }

                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="center">' . $row['date_peminjaman_start'] . '</td>
                                                            <td align="center">' . $verifikasi . '</td>
                                                            <td align="center" style="">
                                                                <form class="" action="cetak-lp-keluar.php" method="GET">
                                                                    <input type="text" name="cetak" value="' . $row['date_peminjaman_start'] . '" hidden>
                                                                    <button class="btn btn-primary btn-sm" type="submit" name=""><i class="fa fa-file"></i></button>
                                                                </form>
                                                            </td>
                                                            </tr>
                                                            ';
                                                        }
                                                    } else { }
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
            ?>
    </body>
<?php } ?>

</html>