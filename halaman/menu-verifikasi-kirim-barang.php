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

    <body class="hold-transition sidebar-mini layin-fixed">
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
                                <h1>Data Pemintaan Kirim Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active"> Data Permintaan Kirim Barang</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <!-- <a href="tambah-permintaan-brg-Masuk.php"><button type="button" class="btn btn-primary" name="button"><i class="fa fa-plus"></i> Tambah Permintaan Kirim Barang</button></a> -->
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
                                                        <center>Kode Req</center>
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
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT *
                                                    FROM permintaan_barang_in
                                                    WHERE status_permintaan_brg_in = '1'";
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {

                                                        if ($row['status_permintaan_brg_in'] == 0) {
                                                            $brg_sts_in = '<span class="right badge badge-warning">Belum Divalidasi</span>';
                                                        } else {
                                                            $brg_sts_in = '<span class="right badge badge-success">Sudah Divalidasi</span>';
                                                        }

                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['kode_permintaan_brg_in'] . '</td>
                                                            <td align="center">' . $row['date_permintaan_brg_in'] . '</td>
                                                            <td align="center">' . $brg_sts_in . '</td>
                                                            <td align="center" style="">
                                                                <form class="" action="detail-permintaan-brg-in.php" method="GET">
                                                                <input type="text" name="detail" value="' . md5($row['kode_permintaan_brg_in']) . '" hidden>
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
        if (isset($_GET['tambah']) or isset($_GET['edit']) or isset($_GET['delete'])) {
            if ($_GET['tambah'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Stok Barang berhasil ditambahkan.");
                    </script>
                    ';
            } elseif ($_GET['edit'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Stok Barang berhasil diubah.");
                    </script>
                    ';
            } elseif ($_GET['delete'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Stok Barang berhasil dihapus.");
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