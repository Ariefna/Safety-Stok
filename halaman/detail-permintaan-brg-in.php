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

    <body class="hold-transition sidebar-mini layin-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['detail'])) {
                $sql = 'SELECT * FROM detail_permintaan_in WHERE md5(kode_permintaan_brg_in)="' . $_GET['detail'] . '"';
                // echo $sql;
                $i = 1;
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $id_detail_permintaan_in           = $row['id_detail_permintaan_in'];
                        $kode_permintaan_brg_in            = $row['kode_permintaan_brg_in'];
                        $id_barang                          = $row['id_barang'];
                        $jumlah_permintaan_barang_in       = $row['jumlah_permintaan_barang_in'];
                    }
                } else {
                }
            }
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Detail Permintaan Barang Masuk</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Detail Permintaan Barang Masuk</li>
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
                                                        <center>Qty Permintaan</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT a.*,(SELECT status_permintaan_brg_in FROM permintaan_barang_in WHERE kode_permintaan_brg_in=a.kode_permintaan_brg_in) status_permintaan_brg_in, b.nama_barang, b.no_serial, c.nama_satuan_barang
                                                    FROM detail_permintaan_in a JOIN barang b ON a.id_barang = b.id_barang
                                                    JOIN satuan_barang c ON b.id_satuan_barang = c.id_satuan_barang
                                                    WHERE kode_permintaan_brg_in = '$kode_permintaan_brg_in'";
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {

                                                        if ($row['status_permintaan_brg_in'] == 1) {
                                                            $verifikasi = '<span class="right badge badge-warning">Panding</span>';
                                                        } elseif ($row['status_permintaan_brg_in'] == 2) {
                                                            $verifikasi = '<span class="right badge badge-success">Approved</span>';
                                                        } else {
                                                            $verifikasi = '<span class="right badge badge-danger">Not approved</span>';
                                                        }

                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="center">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_satuan_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_permintaan_barang_in'] . '</td>
                                                            <td align="center">' . $verifikasi . '</td>
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
        <?php include 'template/script.php'; ?>

    </body>
<?php } ?>

</html>