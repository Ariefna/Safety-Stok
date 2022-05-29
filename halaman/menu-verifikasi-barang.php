<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 200;
    include 'template/head.php';
    $your_id = $_SESSION['id_user'];
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
                                <h1>Data Permintaan Barang Baru</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Data Permintaan Barang Baru</li>
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
                                                <tr>
                                                    <th width="5%">
                                                        <center>NO</center>
                                                    </th>
                                                    <th>
                                                        <center>No Request</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal Req</center>
                                                    </th>
                                                  
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th>
                                                        <center>Detail</center>
                                                    </th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT *
                                                    FROM pengajuan_barang_baru
                                                    WHERE status_pengajuan = 0";
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_pengajuan'] == 0) {
                                                                $status_pengajuan = '<span class="right badge badge-warning">Belum Divalidasi</span>';
                                                            } else {
                                                                $status_pengajuan = '<span class="right badge badge-success">Sudah Divalidasi</span>';
                                                            }

                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_request'] . '</td>
                                                            <td align="center">' . $row['tanggal_pengajuan'] . '</td>
                                                            <td align="center">' . $status_pengajuan . '</td>
                                                            <td align="center" style="">
                                                                <form class="" action="detail-verifikasi-barang-baru.php" method="GET">
                                                                <input type="text" name="detail" value="' . $row['no_request'] . '" hidden>
                                                                <button class="btn btn-primary btn-sm" type="submit" name=""><i class="fa fa-eye"></i></button>
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
            if (isset($_GET['eval']) or isset($_GET['edit']) or isset($_GET['delete'])) {
                if ($_GET['eval'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil dievaluasi.");
                    </script>
                    ';
                } elseif ($_GET['edit'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil diubah.");
                    </script>
                    ';
                } elseif ($_GET['delete'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil dihapus.");
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