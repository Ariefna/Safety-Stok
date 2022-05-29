<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 0;
    include 'template/head.php';
    $your_id = $_SESSION['id_user']
    ?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['detail'])) {
                    $sql = 'SELECT * FROM detail_peminjaman WHERE md5(no_peminjaman)="' . $_GET['detail'] . '"';
                    $i = 1;
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $id_detail_peminjaman           = $row['id_detail_peminjaman'];
                            $no_peminjaman                  = $row['no_peminjaman'];
                            $id_barang                      = $row['id_barang'];
                            $jumlah_barang                  = $row['jumlah_barang'];
                            $status_peminjaman_barang       = $row['status_peminjaman_barang'];
                        }
                    } else { }
                }
                ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Detail Peminjaman Barang Keluar</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Detail Peminjaman Barang Keluar</li>
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
                                                        <center>No Serial</center>
                                                    </th>
                                                    <th>
                                                        <center>Jenis Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Jumlah</center>
                                                    </th>
                                                    <th>
                                                        <center>Status Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Status Pinjam</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT a.*, b.nama_barang, b.no_serial, c.nama_jenis_barang
                                                    FROM detail_peminjaman a JOIN barang b ON a.id_barang = b.id_barang
                                                    JOIN jenis_barang c ON b.id_jenis_barang = c.id_jenis_barang
                                                    WHERE no_peminjaman = '$no_peminjaman'";
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_peminjaman_barang'] == 0) {
                                                                $verifikasi = '<span class="right badge badge-warning">Panding</span>';
                                                                $pinjamya = '<span class="right badge badge-warning">Panding</span>';
                                                            } elseif ($row['status_peminjaman_barang'] == 1) {
                                                                $verifikasi = '<span class="right badge badge-success">Approved</span>';
                                                                $pinjamya = '<span class="right badge badge-success">Dipinjam</span>';
                                                            } else {
                                                                $verifikasi = '<span class="right badge badge-danger">Not approved</span>';
                                                                $pinjamya = '<span class="right badge badge-danger">Tidak Dapat Dipinjam</span>';
                                                            }


                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_barang'] . '</td>
                                                            <td align="center">' . $verifikasi . '</td>
                                                            <td align="center">' . $pinjamya . '</td>
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
        <?php include 'template/script.php'; ?>

    </body>
<?php } ?>

</html>