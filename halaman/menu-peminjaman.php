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
                                <h1>Data Peminjaman Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active"> Data Peminjaman Barang</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <a href="tambah-peminjaman.php"><button type="button" class="btn btn-primary" name="button"><i class="fa fa-plus"></i> Tambah Peminjaman Barang</button></a>
                                <br><br>
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
                                                        <center>Kode Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal Mulai</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal Selesai</center>
                                                    </th>
                                                    <th>
                                                        <center>Durasi</center>
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
                                                    FROM peminjaman_barang
                                                    WHERE id_user = '$your_id'";
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_peminjaman'] == 0) {
                                                                $brg_sts_pinjam = '<span class="right badge badge-warning">Belum Divalidasi</span>';
                                                            } else {
                                                                $brg_sts_pinjam = '<span class="right badge badge-success">Sudah Divalidasi</span>';
                                                            }

                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_peminjaman'] . '</td>
                                                            <td align="center">' . $row['date_input_pinjam'] . '</td>
                                                            <td align="center">' . $row['date_peminjaman_start'] . '</td>
                                                            <td align="center">' . $row['date_peminjaman_end'] . '</td>
                                                            <td align="center">' . $row['durasi_peminjaman'] . ' Hari</td>
                                                            <td align="center">' . $brg_sts_pinjam . '</td>
                                                            <td align="center" style="">
                                                                <form class="" action="detail-peminjaman-barang.php" method="GET">
                                                                <input type="text" name="detail" value="' . md5($row['no_peminjaman']) . '" hidden>
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
            if (isset($_GET['tambah']) or isset($_GET['edit']) or isset($_GET['delete'])) {
                if ($_GET['tambah'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Peminjaman berhasil ditambahkan.");
                    </script>
                    ';
                } elseif ($_GET['edit'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Peminjaman berhasil diubah.");
                    </script>
                    ';
                } elseif ($_GET['delete'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Peminjaman berhasil dihapus.");
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