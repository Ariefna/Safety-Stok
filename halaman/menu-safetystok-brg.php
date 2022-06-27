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
                                <h1>Data Safety Stok</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                    <li class="breadcrumb-item active">Data Safety Stok</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
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
                                                        <center>Kode Barcode</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Qty Sekarang</center>
                                                    </th>
                                                    <th>
                                                        <center>Safety Stok</center>
                                                    </th>
                                                    <th>
                                                        <center>Satuan</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = 'SELECT a.*, b.nama_satuan_barang, (select round(avg(jumlah_permintaan_barang_out),0) keluar from detail_permintaan_out where id_barang = a.id_barang group by id_barang) safetystok, (select sum(jumlah_permintaan_barang_out) from detail_permintaan_out where id_barang = a.id_barang) keluar, (select sum(jumlah_permintaan_barang_in) from detail_permintaan_in where status_in=1 AND id_barang = a.id_barang) masuk, (select round(avg(jumlah_permintaan_barang_out),0) from detail_permintaan_out where id_barang = a.id_barang) rata_keluar FROM barang a JOIN satuan_barang b ON a.id_satuan_barang = b.id_satuan_barang group by a.id_barang';
                                                // echo $sql;
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                      $safetystok = $row['safetystok']*2;
                                                      $qtynow = $row['jumlah_barang'] + $row['masuk'] - $row['keluar'];
                                                      if ($qtynow<=$safetystok) {
                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_request'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $qtynow . '</td>
                                                            <td align="center">' . $safetystok . '</td>
                                                            <td align="">' . $row['nama_satuan_barang'] . '</td>
                                                            </tr>
                                                            ';
                                                      }

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
        if (isset($_GET['tambah']) or isset($_GET['edit']) or isset($_GET['delete']) or isset($_GET['simpan'])) {
            if ($_GET['tambah'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil ditambahkan.");
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
            } elseif ($_GET['simpan'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Safety Stok berhasil disimpan.");
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
