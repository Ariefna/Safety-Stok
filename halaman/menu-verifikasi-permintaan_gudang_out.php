<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 200;
    include 'template/head.php';
    $your_id = $_SESSION['id_user']
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
                                <h1>Data Pemintaan Gudang Barang Keluar</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active"> Data Permintaan Gudang Barang Keluar</li>
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
                                                        <center>Kode Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Karyawan</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th>
                                                        <center>Detail</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT a.*, b.nama_user
                                                    FROM permintaan_barang_out a JOIN users b ON a.id_user = b.id_user
                                                    WHERE a.status_permintaan_brg_out > 0";
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {

                                                        if ($row['status_permintaan_brg_out'] == 1) {
                                                            $brg_sts_out = '<span class="right badge badge-warning">Belum Divalidasi</span>';
                                                        } elseif ($row['status_permintaan_brg_out'] == 2) {
                                                            $brg_sts_out = '<span class="right badge badge-success">Sudah Divalidasi</span>';
                                                        }

                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['kode_permintaan_brg_out'] . '</td>
                                                            <td align="center">' . $row['date_permintaan_brg_out'] . '</td>
                                                            <td align="center">' . $row['nama_user'] . '</td>
                                                            <td align="center">' . $brg_sts_out . '</td>
                                                            <td align="center" style="">
                                                                <form class="" action="detail-verifikasi-permintaan-barang-keluar-gudang.php" method="GET">
                                                                <input type="text" name="detail" value="' . md5($row['kode_permintaan_brg_out']) . '" hidden>
                                                                <input type="text" name="id" value="' . $row['id_permintaan_brg_out'] . '" hidden>
                                                                <button class="btn btn-primary btn-sm" type="submit" name=""><i class="fa fa-eye"></i></button>
                                                                </form>
                                                            </td>
                                                            </tr>
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
        if (isset($_GET['acc']) or isset($_GET['tidakacc']) or isset($_GET['save'])) {
            if ($_GET['acc'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Permintaan berhasil diverifikasi.");
                    </script>
                    ';
            } elseif ($_GET['tidakacc'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Permintaan berhasil <b>TIDAK</b> diverifikasi.");
                    </script>
                    ';
            } elseif ($_GET['save'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Verifikasi berhasil disimpan.");
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