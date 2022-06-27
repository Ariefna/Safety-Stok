<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 0;
    include 'template/head.php';
    $your_id = $_SESSION['id_user'];
    $id_prt_brd = $_GET['id'];
?>

    <body class="hold-transition sidebar-mini layout-fixed">
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
                                <h1>Detail Verifikasi Gudang Barang Masuk</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Detail Verifikasi Gudang Barang Masuk</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                              <?php
                              $cek_status_ya = "SELECT * FROM permintaan_barang_in WHERE kode_permintaan_brg_in = '$kode_permintaan_brg_in'";
                              $query_cek_status_ya = mysqli_query($conn, $cek_status_ya);
                              while ($get_aja = mysqli_fetch_array($query_cek_status_ya)) {

                                    $a = $get_aja['status_permintaan_brg_in'];

                                  if ($a == 2) {
                                      $cek_but_sts = 'disabled';
                                  } else {
                                      $cek_but_sts = '';
                                  }
                              }
                               ?>
                                <a href="config/add-verifikasi-permintaan_in_gudang.php?id=<?php echo $id_prt_brd; ?>&kode=<?php echo $kode_permintaan_brg_in; ?>">
                                    <button <?php echo $cek_but_sts; ?> type="submit" class="btn btn-success" name="save_verifikasi" value="<?php echo $id_prt_brd; ?>">
                                        <i class="fa fa-save"></i> Konfirmasi Hasil Verfikasi
                                    </button>
                                </a>
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
                                                        <center>No Serial</center>
                                                    </th>
                                                    <th>
                                                        <center>Jenis Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Qty</center>
                                                    </th>
                                                    <th>
                                                        <center>Karyawan</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT a.*, us.nama_user, b.nama_barang, b.no_serial, b.jumlah_barang, c.nama_satuan_barang, ot.id_permintaan_brg_in
                                                    FROM permintaan_barang_in ot JOIN users us ON ot.id_user = us.id_user
                                                    JOIN detail_permintaan_in a ON ot.kode_permintaan_brg_in = a.kode_permintaan_brg_in
                                                    JOIN barang b ON a.id_barang = b.id_barang
                                                    JOIN satuan_barang c ON b.id_satuan_barang = c.id_satuan_barang
                                                    WHERE a.kode_permintaan_brg_in = '$kode_permintaan_brg_in'";
                                                // echo $sql;
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {

                                                        $cek_sty_empety = "SELECT id_barang AS cek_id, hasil_sty FROM safety_stok WHERE id_barang = $row[id_barang]";
                                                        $query_cek_sty_empety = mysqli_query($conn, $cek_sty_empety);
                                                        $row_empety = mysqli_fetch_array($query_cek_sty_empety);

                                                        $hasil_cek_sty = $row_empety['hasil_sty'];
                                                        $hasil_cek_id = $row_empety['cek_id'];

                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="center">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_satuan_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_permintaan_barang_in'] . '</td>
                                                            <td align="center">' . $row['nama_user'] . '</td>
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
