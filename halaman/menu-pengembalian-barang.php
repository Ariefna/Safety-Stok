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

    date_default_timezone_set('Asia/Jakarta');
    $cek_date_now = date('Y-m-d');
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
                                <h1>Data Pengembalian Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active"> Data Pengembalian Barang</li>
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
                                                        <center>No Pinjam</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Peminjam</center>
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
                                                        <center>Status Pinjam</center>
                                                    </th>
                                                    <th>
                                                        <center>Status Kembali</center>
                                                    </th>
                                                    <th>
                                                        <center>Detail</center>
                                                    </th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT a.*, b.nama_user
                                                    FROM peminjaman_barang a JOIN users b ON a.id_user = b.id_user
                                                    WHERE a.status_peminjaman IN (1, 2)";
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_peminjaman'] == 1) {
                                                                $brg_sts_pinjam = '<span class="right badge badge-primary">Dipinjamkan</span>';
                                                                $brg_sts_ok = '';
                                                            } else {
                                                                $brg_sts_pinjam = '<span class="right badge badge-success">Sudah Dikembalikan</span>';
                                                                $brg_sts_ok = 'disabled';
                                                            } 

                                                            if ($row['date_peminjaman_end'] == $cek_date_now) {
                                                                $brg_sts_tempo = '<span class="right badge badge-primary">Hari Pengembalian</span>';
                                                            } elseif ($row['date_peminjaman_end'] < $cek_date_now) {
                                                                $brg_sts_tempo = '<span class="right badge badge-danger">Lewat Hari Pengembalian</span>';
                                                            } else {
                                                                $brg_sts_tempo = '<span class="right badge badge-warning">Belum Waktu Pengembalian</span>';
                                                            }

                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_peminjaman'] . '</td>
                                                            <td align="">' . $row['nama_user'] . '</td>
                                                            <td align="center">' . $row['date_peminjaman_start'] . '</td>
                                                            <td align="center">' . $row['date_peminjaman_end'] . '</td>
                                                            <td align="center">' . $row['durasi_peminjaman'] . ' Hari</td>
                                                            <td align="center">' . $brg_sts_pinjam . '</td>
                                                            <td align="center">' . $brg_sts_tempo . '</td>
                                                            <td align="center" style="">
                                                                <form class="" action="detail-pengembalian-barang.php" method="GET">
                                                                <input type="text" name="detail" value="' . md5($row['no_peminjaman']) . '" hidden>
                                                                <input type="text" name="id" value="' . $row['id_peminjaman'] . '" hidden>
                                                                <button '. $brg_sts_ok.' class="btn btn-primary btn-sm" type="submit" name=""><i class="fa fa-eye"></i></button>
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
            if (isset($_GET['save'])) {
                if ($_GET['save'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Pengembalian berhasil disimpan.");
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